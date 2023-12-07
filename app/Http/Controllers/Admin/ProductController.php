<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Auctiontype;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Project;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traits\ImageTrait;
use Auth;
use Illuminate\Validation\Rules;
use GoogleTranslate;
use App\Models\Language;


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
        $projects = Project::where('status', 1)->get();
        $projectCategoryIds = $projects->pluck('category_id')->toArray();
        $auctiontype = Auctiontype::where('status', 1)->get();
        // $categories = Category::whereIn('id', $projectCategoryIds)->get();
        return view('admin.products.create', compact( 'auctiontype','projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'auction_type_id' => 'required',
            'auction_end_date' => '',
            'project_id'    => 'required',
            'reserved_price' => 'required',
            'description' => 'required|string',
            'status' => 'required',
            'is_popular' => 'boolean',
            'image_path.*' => 'required',
            'end_price' =>'',
            'start_price' => '',
        ]);
        // Generate the slug
       $data['slug'] = $this->getUniqueSlug($data['title']);
       $identifier = sprintf('%04d', mt_rand(1, 9999));
       // Generate the lot number
       $lotNumber = 'Lot-' . $identifier;
       
       $data['lot_no'] = $lotNumber;
       
    
       if ($request->has('start_price')) {
        $data['start_price'] = $request->input('start_price');
        } else {
            $data['start_price'] = null; 
        }
        $languages = Language::where('status', 1)->get();
       foreach ($languages as $language) {
           if ($language->short_name === 'en') {
               $langId = 'en';
   
               $productData = [
                   'title' => $data['title'],
                   'auction_type_id' => $data['auction_type_id'],
                   'project_id'      => $data['project_id'],
                   'reserved_price' => $data['reserved_price'],
                   'description' => $data['description'],
                   'status' => $data['status'],
                   'slug' => $data['slug'],
                   'is_popular' => $data['is_popular'],
                   'end_price'  => $data['end_price'],
                   'start_price' => $data['start_price'],
                   'lang_id' => $langId,
                   'lot_no' => $data['lot_no']
               ];
           } else{
                    $langIds = session('locale');
                    $translatedTitle = GoogleTranslate::trans($data['title'],  $langIds);
                    $translatedDesc = GoogleTranslate::trans($data['description'],  $langIds);
                    $productData = [
                        'title' =>  $translatedTitle,
                        'auction_type_id' => $data['auction_type_id'],
                        'project_id'      => $data['project_id'],
                        'reserved_price' => $data['reserved_price'],
                        'description' => $translatedDesc,
                        'status' => $data['status'],
                        'slug' => $data['slug'],
                        'is_popular' => $data['is_popular'],
                        'end_price'  => $data['end_price'],
                        'start_price' => $data['start_price'],
                        'lang_id' => $langIds,
                        'lot_no' => $data['lot_no']
                    ];
                    
           }
        }

       $pro = Product::create($productData);
     
        if ($request->hasFile('image_path')) {
            foreach ($request->file('image_path') as $file) {
                $filename = date('YmdHi') . "-" . uniqid() . "." . $file->extension();
                $filePath = $file->move(public_path('product/gallery'), $filename);
                $url = asset('product/gallery/' . $filename);
                Gallery::create([
                    'product_id' => $pro->id,
                    'image_path' => $url,
                ]);
            }
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

        return view('admin.products.edit', compact('categories', 'subcat', 'auctiontype', 'brands', 'product', 'galleryImages'));
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

    public function getcategories(Request $request, $auction)
    {
        $subcategories = Category::where('auction_type_id', $auction)->get();
        return response()->json($subcategories);
    }

    public function getprojects(Request $request, $project)
    {
        $projects = Project::where('auction_type_id', $project)->get();
        return response()->json($projects);
    }



    protected function getUniqueSlug($title)
    {
        $slug = Str::slug($title); // Generate the slug

        // Check if the slug is already taken
        $count = Product::where('slug', $slug)->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        return $slug;
    }
}
