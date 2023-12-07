<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Auctiontype;
use App\Models\Category;
use App\Models\Language;
use App\Traits\ImageTrait;
use GoogleTranslate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    use ImageTrait;

    /**
     * Display a listing of the resource.
     */
    public function change(Request $request)
    {
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);

        return redirect()->back();
    }
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.categories.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $language = Language::where('status', 1)->get();

        $auctiontype = Auctiontype::where('status', 1)->get();
        return view('admin.categories.create', compact('auctiontype', 'language'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'status' => 'required|boolean',
    //     ]);

    //     // Generate the slug
    //     $data['slug'] = $this->getUniqueSlug($data['name']);

    //     if ($request->hasFile('image_path')) {
    //         $data['image_path'] = $this->verifyAndUpload($request, 'image_path');
    //     }

    //     $langId = session('locale');
    //     $translatedName = GoogleTranslate::trans($data['name'], $langId);
    //     $translatedDesc = GoogleTranslate::trans($data['description'], $langId);

    //     $data['name'] = $translatedName;
    //     $data['description'] = $translatedDesc;
    //     $data['lang_id'] = $langId;

    //     // Create the category
    //     $category = Category::create($data);

    //     return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
    // }
    public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'required|boolean',
    ]);

    // Generate the slug
    $data['slug'] = $this->getUniqueSlug($data['name']);

    if ($request->hasFile('image_path')) {
        $data['image_path'] = $this->verifyAndUpload($request, 'image_path');
    }

    $languages = Language::where('status', 1)->get();

    foreach ($languages as $language) {
        if ($language->short_name === 'en') {
            $langId = 'en';

            $categoryData = [
                'name' => $data['name'],
                'description' => $data['description'],
                'image_path' => $data['image_path'],
                'status' => $data['status'],
                'slug' => $data['slug'],
                'lang_id' => $langId,
            ];
        } else {
            $langIds = session('locale');
            $translatedName = GoogleTranslate::trans($data['name'],  $langIds);
            $translatedDesc = GoogleTranslate::trans($data['description'],  $langIds);

            $categoryData = [
                'name' => $translatedName,
                'description' => $translatedDesc,
                'image_path' => $data['image_path'],
                'status' => $data['status'],
                'slug' => $data['slug'],
                'lang_id' =>  $langIds,
            ];
        }

        // Create the category for each language
        Category::create($categoryData);
    }

    return redirect()->route('admin.categories.index')->with('success', 'Categories created successfully!');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $auctiontype = Auctiontype::where('status', 1)->get();
        return view('admin.categories.edit', compact('category', 'auctiontype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
            // 'auction_type_id' => ''
        ]);

        // Generate the slug
        $data['slug'] = $this->getUniqueSlug($data['name']);
        if ($request->hasFile('image_path')) {
            $data['image_path'] = $this->verifyAndUpload($request, 'image_path');
        }
        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
    }

    protected function getUniqueSlug($name)
    {
        $slug = Str::slug($name); // Generate the slug

        // Check if the slug is already taken
        $count = Category::where('slug', $slug)->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1); // Append a number to make it unique
        }

        return $slug;
    }
}
