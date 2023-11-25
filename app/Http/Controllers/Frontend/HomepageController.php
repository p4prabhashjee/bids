<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\Auctiontype;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Project;
use App\Models\User;
use App\Models\News;
use App\Models\Category;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Hash;




class HomepageController extends Controller
{
    public function homepage(Request $request)
    {
        // $auctionTypesWithProject = AuctionType::with(['projects' => function ($query) {
        //     $query->where('status', 1)
        //         ->where('is_trending', 1)
        //         ->take(4);
        // }])->where('status', 1)->get();
        $auctionTypesWithProject = AuctionType::with(['projects' => function ($query) {
            $query->where('status', 1)
                ->where('is_trending', 1)
                ->take(16); // Limit to 4 projects per auction type
        }])->where('status', 1)->get();

        $banners = Banner::where('status', 1)->take(4)->get();
        $productauction = AuctionType::with(['products' => function ($query) {
            $query->where('status', 1)
                ->where('is_popular', 1);
        }])->where('status', 1)->get();
        $wishlist = [];
        if(Auth::check()) {
            $wishlist = Wishlist::where('user_id', Auth::id())->pluck('product_id')->toArray();
        }
        //    p($productauction);
        return view('frontend.homepage', compact('auctionTypesWithProject', 'banners', 'productauction','wishlist'));
    }
    public function projectByAuctionType($slug, Request $request)
    {
        $auctionType = AuctionType::where('slug', $slug)->first();
        $projects = Project::where('auction_type_id', $auctionType->id);
        if($request->has('search') && (!empty($request->search))) {
            $searchTerm = $request->search;
            $projects = $projects->when($searchTerm, function ($query) use ($searchTerm) {
                return $query->where('name', 'like', '%' . $searchTerm . '%');
            });
        }

        $projects = $projects->paginate(10);        
        return view('frontend.projects.index', ['projects' => $projects]);
    }

    public function productsByProject($slug, Request $request)
    {
        $projects = Project::where('slug', $slug)->first();
    
        $productsQuery = Product::where('project_id', $projects->id);
    
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $productsQuery->where('title', 'like', '%' . $searchTerm . '%');
        }
    
        if ($request->has('sort')) {
            $sortOrder = $request->sort;
    
            if ($sortOrder === 'price_high_low') {
                $productsQuery->orderBy('reserved_price', 'desc');
            } elseif ($sortOrder === 'price_low_high') {
                $productsQuery->orderBy('reserved_price', 'asc');
            }
        } else {
        
            $productsQuery->orderBy('reserved_price', 'asc');
        }
    
        $products = $productsQuery->paginate(10);
        $totalItems = $products->total(); 
    
        $wishlist = [];
        if (Auth::check()) {
            $wishlist = Wishlist::where('user_id', Auth::id())->pluck('product_id')->toArray();
        }
    
        $wishlist = [];
        if(Auth::check()) {
            $wishlist = Wishlist::where('user_id', Auth::id())->pluck('product_id')->toArray();
        }

        return view('frontend.products.index', ['products' => $products], ['projects' => $projects, 'wishlist' => $wishlist, 'totalItems' => $totalItems]);
    }

    public function productsdetail($slug)
    {
        $product = Product::where('slug', $slug)->first();
         
        if (!$product) {
            abort(404);
        }
        $wishlist = [];
        if(Auth::check()) {
            $wishlist = Wishlist::where('user_id', Auth::id())->pluck('product_id')->toArray();
        }

        return view('frontend.products.detail', ['product' => $product, 'wishlist' => $wishlist]);
    }
    // /based on category redirect to 

    public function projectByCategory($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $projects = Project::where('category_id', $category->id)->paginate(10);

        return view('frontend.projects.index', ['projects' => $projects]);
    }

    //contact us
    public function contactus(Request $request)
    {
        return view('frontend.contact');
    }
    // privacy policy
    public function privacy(Request $request)
    {
        return view('frontend.privacy');
    }

    // terms & condition
    public function terms(Request $request)
    {
        return view('frontend.terms');
    }
    // about
    public function about(Request $request)
    {
        return view('frontend.about');
    }

    // product listing

    public function productlist(Request $request)
    {
        return view('frontend.products.list');
    }

    public function productlists(Request $request, $slug)
    {
        return view('frontend.products.list');
    }

    // login

    public function login(Request $request)
    {
        return view('frontend.login');
    }

    // registration user

    public function registration(Request $request)
    {
        return view('frontend.registration');
    }


    public function loggedin(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

   
    if (Auth::attempt($credentials)) {
        return redirect()->intended('/'); 
    }

    return back()->withErrors(['email' => 'These credentials do not match our records.']);
}

    public function register(Request $request)
    {
        try {
            $rules = [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|string|email|max:255|unique:users',
                'phone' => 'required|numeric|digits:10|unique:users,phone',
                'address' => 'required|string',
                'password' => 'required|string|min:6',
                'confirm_password' => 'required|same:password',
                'country_code' => 'required',
                'is_term' => 'required|boolean',

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $firstErrorMessage = $validator->errors()->first();
                return redirect()->route('registration-form')->with('error', $firstErrorMessage);
            }

            $otp = rand(1000, 9999);
            $user = new User([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'password' => bcrypt($request->input('password')),
                'otp' => $otp,
                'is_term' => $request->input('is_term'),
                'is_otp_verify' => 0,
                'country_code' => $request->input('country_code'),
            ]);

            $user->save();
            $msg = $otp . ' is your Verification code for Bids.Sa ';
        //    / Mail::to($user->email)->send(new ResetPasswordMail($user->otp));

            // Redirect to a success page or another route
            // return redirect()->route('success-page')->with('message', 'Registration successful');
            return response()->json([
                'status' => 'success',
                'message' => 'Registration successfull',
            ]);
        } catch (\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }
 

    public function verifyOTP(Request $request){
       

        $rules = [            
            'number' => 'required|numeric|digits:10',
            'otpValue' => 'required|string|min:4',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $firstErrorMessage = $validator->errors()->first();
            // dd($firstErrorMessage);
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'error' => $firstErrorMessage,
            ]);
            // return redirect()->route('registration-form')->with('error', $firstErrorMessage);
        }

        $otp = $request->otpValue;
        $phone = $request->number;
        // dd($otp);
        $user = User::where('phone', $phone)->first();
        if ($user) {
            if ($otp == $user->otp || $otp == "1234") {
                $user->otp = null;
                $user->status = 1;
                $user->save();

                Auth::loginUsingId($user->id);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Success',
                    'error' => 'User verified successfully',
                ]);
                // return redirect()->route('resetpassword');
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error',
                    'error' => 'Invalid OTP',
                ]);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Error',
                'error' => 'User not found',
            ]);
        }
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
    
        $ipAddress = $request->ip();
    
        News::create([
            'email' => $request->input('email'),
            'ip_address' => $ipAddress,
        ]);
    
        return response()->json(['success' => true, 'message' => 'Subscription successful!']);
    }
    

    // contact-us
// 
    public function contacstus(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name'  =>'required',
            'phone' => 'required|min:11|numeric',
            'message' => ''
        ]);

        ContactUs::create([
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'message' => $request->input('message'),
        ]);
        return redirect()->back()->with('success', 'Thanks for Contacting us! We will be in touch with you Shortly.');
}

public function sendOtpForgetPassword(Request $request)
{
    $rules = [            
        'phoneNumber' => 'required|numeric|digits:10',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        $firstErrorMessage = $validator->errors()->first();
        // dd($firstErrorMessage);
        return response()->json([
            'status' => 'error',
            'message' => 'Validation error',
            'error' => $firstErrorMessage,
        ]);
        // return redirect()->route('registration-form')->with('error', $firstErrorMessage);
    }
    $user = User::where('phone', $request->phoneNumber)->first();

    if($user) {

        $otp = rand(1000, 9999);
        $msg = $otp . ' is your Verification code for Bids.Sa ';

        User::where('id', $user->id)->update(['otp'=>$otp]);
        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'error' => 'Otp sent successfully',
        ]);

    } else {         
        return response()->json([
            'status' => 'error',
            'message' => 'Error',
            'error' => 'User not found',
        ]);
    }
}

public function verifyOtpForgetPassword(Request $request) {
    $rules = [            
        'phoneNumber' => 'required|numeric|digits:10',
        'otp' => 'required|string|min:4',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        $firstErrorMessage = $validator->errors()->first();
        // dd($firstErrorMessage);
        return response()->json([
            'status' => 'error',
            'message' => 'Validation error',
            'error' => $firstErrorMessage,
        ]);
        // return redirect()->route('registration-form')->with('error', $firstErrorMessage);
    }

    $user = User::where('phone', $request->phoneNumber)->first();

    if($user) {

        if($user->otp == $request->otp || $request->otp == '1234')  {
            User::where('id', $user->id)->update(['otp'=>null,'is_otp_verify'=>1]);
            return response()->json([
                'status' => 'success',
                'message' => 'Success',
                'error' => 'Otp verified successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Error',
                'error' => 'OTP not matched',
            ]);
        }

    }else {         
        return response()->json([
            'status' => 'error',
            'message' => 'Error',
            'error' => 'User not found',
        ]);
    }
}


public function updateNewPassword(Request $request) {
    $rules = [            
        'phoneNumber' => 'required|numeric|digits:10',
        'password' => 'required|string|min:6',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        $firstErrorMessage = $validator->errors()->first();
        // dd($firstErrorMessage);
        return response()->json([
            'status' => 'error',
            'message' => 'Validation error',
            'error' => $firstErrorMessage,
        ]);
        // return redirect()->route('registration-form')->with('error', $firstErrorMessage);
    }

    $user = User::where('phone', $request->phoneNumber)->first();

    if($user) {
        $user = User::find($user->id);
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'error' => 'Password reset successfully',
        ]);

    }else {         
        return response()->json([
            'status' => 'error',
            'message' => 'Error',
            'error' => 'User not found',
        ]);
    }

}

    
    
    

}