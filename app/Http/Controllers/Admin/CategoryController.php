<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\CategoryDataTable;
use App\Models\Category;
use Auth;
use App\Traits\ImageTrait;
use Illuminate\Support\Str;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.categories.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|boolean', 
        ]);
        // Generate the slug
        $data['slug'] = $this->getUniqueSlug($data['name']);
        $blog = Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
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
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|boolean', 
        ]);

        // Generate the slug
        $data['slug'] = $this->getUniqueSlug($data['name']);
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
