<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\BannerDataTable;
use Auth;
use App\Traits\ImageTrait;
use App\Models\Banner;
use App\Models\Project;




class BannerController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(BannerDataTable $dataTable)
    {
        return $dataTable->render('admin.banners.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project=Project::where('status', 1)->get();
        return view('admin.banners.create',compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url'        => 'required',
            'status' => 'required|boolean', 
        ]);
        if ($request->hasFile('image_path')) {
            $data['image_path'] = $this->verifyAndUpload($request, 'image_path');
        }
        // Generate the slug
        $banners = Banner::create($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner created successfully!');
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
    public function edit(Banner $banner)
    {
        $project=Project::where('status', 1)->get();
        return view('admin.banners.edit', compact('banner','project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $data = $request->validate([
            'title' => 'string|max:255',
            'description' => 'string',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'url'        => '',
            'status' => 'boolean', 
        ]);

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $this->verifyAndUpload($request, 'image_path');
        }
    
        $banner->update($data);
        
        return redirect()->route('admin.banners.index')->with('success', 'Banner updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully');
    }
}
