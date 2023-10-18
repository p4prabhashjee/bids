<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Auctiontype;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Gallery;
use App\Models\Subcategory;
use App\Models\Specification;
use Illuminate\Http\Request;
use Auth;
use App\Traits\ImageTrait;
use Illuminate\Support\Str;
use Validator;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        $subcat = Subcategory::whereIn('category_id', $categories->pluck('id'))->get();
        $auctiontype = Auctiontype::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();

        return view('admin.products.create', compact('categories', 'subcat', 'auctiontype', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'auction_type_id' => 'required',
            'auction_start_date' => 'required',
            'auction_end_date' => 'required',
            'auction_start_time' => 'required',
            'auction_end_time' => 'required',
            'reserved_price' => 'required',
            'brand_id' => 'required',
            'description' => 'required|string',
            'status' => 'required',
            'name.*' => 'required',
            'value.*' => 'required',
            'image_path.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Generate the slug
        $validatedData['slug'] = $this->getUniqueSlug($validatedData['title']);
         
    // $validatedData['deposit'] = $request->input('deposit');
    // $validatedData['deposit_amount'] = ($request->input('deposit') == '1') ? $request->input('deposit_amount') : null;

        $pro = Product::create($validatedData);
        if ($request->hasFile('image_path')) {
            foreach ($request->file('image_path') as $file) {
                $filename = date('YmdHi') . "-" . uniqid() . "." . $file->extension();
                $filePath =  $file->move(public_path('product/gallery'), $filename);
                $url = asset('product/gallery/' . $filename);
                Gallery::create([
                    'product_id' => $pro->id,
                    'image_path' => $url,
                ]);
            }
        }
       // Extract name and value arrays
       $names = $request->input('name');
       $values = $request->input('value');
       
       // Create FeaturedChat records for each pair
       foreach ($names as $index => $name) {
           Specification::create([
               'product_id' => $pro->id,
               'name' => htmlspecialchars($name),
               'value' => htmlspecialchars($values[$index]),
           ]);
       }
        

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
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
    public function edit(Product $product)
    {
        $categories = Category::where('status', 1)->get();
        $subcat = Subcategory::whereIn('category_id', $categories->pluck('id'))->get();
        $auctiontype = Auctiontype::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        $galleryImages = Gallery::where('product_id', $product->id)->get();
        // p($galleryImages);
        

        return view('admin.products.edit', compact('categories', 'subcat', 'auctiontype', 'brands','product','galleryImages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    public function getSubcategories($category)
    {
        $subcategories = Subcategory::where('category_id', $category)->get();
        return response()->json($subcategories);
    }

    protected function getUniqueSlug($name)
    {
        $slug = Str::slug($name); // Generate the slug

        // Check if the slug is already taken
        $count = Product::where('slug', $slug)->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        return $slug;
    }
}
