<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules;
use App\Traits\ImageTrait;
use Illuminate\Support\Str;
use GoogleTranslate;
use App\Models\Language;

use App\DataTables\PageDataTable;


class PageController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(PageDataTable $dataTable)
    {
        return $dataTable->render('admin.pages.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'slug' => 'required|unique:pages',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_static' => 'boolean',
        ]);

         $validatedData['slug'] = $this->getUniqueSlug( $validatedData['title']);
         if (!array_key_exists('is_static', $validatedData)) {
            $validatedData['is_static'] = false; 
        }
        if ($request->hasFile('image')) {
             $validatedData['image'] = $this->verifyAndUpload($request, 'image', null, 'pages');
        }
        $languages = Language::where('status', 1)->get();

        foreach ($languages as $language) {
            $langId = 'en';
            $pageData = [
                'title' => $validatedData['title'],
                'content' => $validatedData['content'],
                'is_static' => $validatedData['is_static'],
                'lang_id' => $langId, 
            ];
        
            if ($language->short_name === 'en') {
                if (isset($validatedData['image'])) {
                    $pageData['image'] = $validatedData['image'];
                }
            } else {
                $langIds = session('locale');
                $translatedTitle = GoogleTranslate::trans($validatedData['title'], $langIds);
                $translatedDesc = GoogleTranslate::trans($validatedData['content'], $langIds);
        
                $pageData['title'] = $translatedTitle;
                $pageData['content'] = $translatedDesc;
                $pageData['lang_id'] =  $langIds;
        
                if (isset($validatedData['image'])) {
                    $pageData['image'] = $validatedData['image'];
                }
            }
            
            
            Page::create($pageData);
        }
        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 

        ]);

        // Generate the slug
        $data['slug'] = $this->getUniqueSlug($data['title']);

        // Upload the image
        if($request->hasFile('image')){
            $data['image'] = $this->verifyAndUpload($request, 'image', null, 'pages');
        }

       
        $page->update($data);
        
        return redirect()->route('admin.pages.index')->with('success', 'page updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }

    protected function getUniqueSlug($title)
    {
        $slug = Str::slug($title); // Generate the slug

        // Check if the slug is already taken
        $count = Page::where('slug', $slug)->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1); // Append a number to make it unique
        }

        return $slug;
    }
}