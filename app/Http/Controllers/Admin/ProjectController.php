<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\ProjectDataTable;
use Auth;
use App\Traits\ImageTrait;
use App\Models\Project;
use App\Models\Category;
use App\Models\Auctiontype;
use Illuminate\Support\Str;
use GoogleTranslate;
use App\Models\Language;





class ProjectController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProjectDataTable $dataTable)
    {
        return $dataTable->with('auctiontype')->render('admin.projects.index');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $auctiontype = Auctiontype::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        return view('admin.projects.create',compact('auctiontype','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'status' => 'required|boolean',
            'start_date_time' =>'required', 
            'is_trending'    => 'boolean',
            'auction_type_id' => 'required',
            'buyers_premium'  =>'required',
            'category_id'     => 'required',
            'deposit_amount' =>'',
        ]);

        if (!array_key_exists('is_trending', $data)) {
            $data['is_trending'] = false; 
        }
        $data['slug'] = $this->getUniqueSlug($data['name']);

        // Upload the image
        if($request->hasFile('image_path')){
            $data['image_path'] = $this->verifyAndUpload($request, 'image_path', null, 'projects');
        }
        $languages = Language::where('status', 1)->get();
        foreach ($languages as $language) {
            if ($language->short_name === 'en') {
                $langId = 'en';
    
                $projectData = [
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'image_path' => $data['image_path'],
                    'status' => $data['status'],
                    'start_date_time' =>$data['start_date_time'],
                    'is_trending' =>$data['is_trending'],
                    'auction_type_id' =>$data['auction_type_id'],
                    'buyers_premium'  =>$data['buyers_premium'],
                    'category_id'  => $data['category_id'],
                    'deposit_amount' =>$data['deposit_amount'],
                    'slug' => $data['slug'],
                    'lang_id' => $langId,
                ];
            } else {
                $langIds = session('locale');
                $translatedName = GoogleTranslate::trans($data['name'],  $langIds);
                $translatedDesc = GoogleTranslate::trans($data['description'],  $langIds);
    
                $projectData = [
                    'name' => $translatedName,
                    'description' => $translatedDesc,
                    'image_path' => $data['image_path'],
                    'status' => $data['status'],
                    'start_date_time' =>$data['start_date_time'],
                    'is_trending' =>$data['is_trending'],
                    'auction_type_id' =>$data['auction_type_id'],
                    'buyers_premium'  =>$data['buyers_premium'],
                    'category_id'  => $data['category_id'],
                    'deposit_amount' =>$data['deposit_amount'],
                    'slug' => $data['slug'],
                    'lang_id' =>  $langIds,
                ];
            }

        $pro = Project::create($projectData);

        }
        
        return redirect()->route('admin.projects.index')->with('success', 'Project Created Successfully!');
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
    public function edit(Project $project)
    {
        $auctiontype = Auctiontype::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        return view('admin.projects.edit',compact('auctiontype','project','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'status' => 'required|boolean',
            'start_date_time' =>'', 
            'is_trending'    => 'boolean',
            'auction_type_id' => '',
            'buyers_premium'   => '',
            'category_id'      =>'',
            'deposit_amount' =>'',
        ]);

        // Generate the slug
        $data['slug'] = $this->getUniqueSlug($data['name']);

        // Upload the image
        if($request->hasFile('image_path')){
            $data['image_path'] = $this->verifyAndUpload($request, 'image_path', null, 'projects');
        }

        $project->update($data);
        
        return redirect()->route('admin.projects.index')->with('success', 'Project Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully');
    }


    protected function getUniqueSlug($name)
    {
        $slug = Str::slug($name); 
        // Check if the slug is already taken
        $count = Project::where('slug', $slug)->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1); // Append a number to make it unique
        }

        return $slug;
    }
}
