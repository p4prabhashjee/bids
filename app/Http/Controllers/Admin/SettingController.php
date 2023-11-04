<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Traits\ImageTrait;
use Illuminate\Support\Str;
use App\Models\Setting;


use App\DataTables\SettingDataTable;

class SettingController extends Controller
{
    use ImageTrait;

    /**
     * Display a listing of the resource.
     */
    // 
    public function index(SettingDataTable $dataTable)
    {
        return $dataTable->render('admin.settings.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'value' => 'required',
            'slug' => 'required|unique:settings',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_static' => 'boolean',
        ]);
           // Generate the slug
         $validatedData['slug'] = $this->getUniqueSlug( $validatedData['title']);
        // Upload and save image if provided
        if ($request->hasFile('image')) {
             $validatedData['image'] = $this->verifyAndUpload($request, 'image', null, 'settings');
        }

      
        // Create a new page
        Setting::create($validatedData);

        return redirect()->route('admin.settings.index')->with('success', 'Setting created successfully');
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
    public function edit(Setting $setting)
    {
        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'value' => 'required|string',
            'slug'  => '',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Example image validation

        ]);

        // Upload the image
        if($request->hasFile('image')){
            $data['image'] = $this->verifyAndUpload($request, 'image', null, 'settings');
        }

       
        $setting->update($data);
        
        return redirect()->route('admin.settings.index')->with('success', 'Setting updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();
        return redirect()->route('admin.settings.index')->with('success', 'setting deleted successfully.');
    }


    protected function getUniqueSlug($title)
    {
        $slug = Str::slug($title); // Generate the slug

        // Check if the slug is already taken
        $count = Setting::where('slug', $slug)->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1); 
        }

        return $slug;
    }
}
