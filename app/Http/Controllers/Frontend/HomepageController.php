<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\Auctiontype;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Redirect;
use Illuminate\Support\Facades\Auth;


class HomepageController extends Controller
{
    public function homepage(Request $request)
    {
        $auctionTypesWithProject = AuctionType::with(['projects' => function ($query) {
            $query->where('status', 1)
                ->where('is_trending', 1)
                ->take(4);
        }])->where('status', 1)->get();

        $banners = Banner::where('status', 1)->take(4)->get();
        $productauction = AuctionType::with(['products' => function ($query) {
            $query->where('status', 1)
                ->where('is_popular', 1);
        }])->where('status', 1)->get();

        //    p($productauction);
        return view('frontend.homepage', compact('auctionTypesWithProject', 'banners', 'productauction'));
    }
    public function projectByAuctionType($slug)
    {
        $auctionType = AuctionType::where('slug', $slug)->first();
        $projects = Project::where('auction_type_id', $auctionType->id)->get();

        return view('frontend.projects.index', ['projects' => $projects]);
    }

    public function productsByProject($slug)
    {
        $projects = Project::where('slug', $slug)->first();
        $products = Product::where('project_id', $projects->id)->get();
        // p($product);

        return view('frontend.products.index', ['products' => $products], ['projects' => $projects]);
    }

    public function productsdetail($slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            abort(404);
        }
        return view('frontend.products.detail', ['product' => $product]);
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
            Mail::to($user->email)->send(new ResetPasswordMail($user->otp));

            // Redirect to a success page or another route
            return redirect()->route('success-page')->with('message', 'Registration successful');

        } catch (\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }
    // public function verifyOTP(Request $request)
    // {
    //     try {
    //         $user = Auth::user(); 
    //         $otp = $request->input('otp');
    
    //         if ($user->otp === $otp) {
    //             $user->is_otp_verify = 1;
    //             $user->save();
    
    //             return redirect()->route('success-page')->with('message', 'OTP verified successfully');
    //         } else {
    //             return redirect()->route('registration-form')->with('error', 'Invalid OTP. Please try again.');
    //         }
    //     } catch (\Exception $e) {
    //         return redirect()->route('registration-form')->with('error', $e->getMessage());
    //     }
    // }

    public function verifyOTP(Request $request){
        $phone = $request->phone; 
        $first = $request->first;
        $second = $request->second;
        $third = $request->third;
        $fourth = $request->fourth;
        $requestotp = $first . $second . $third . $fourth;
    
        $user = User::where('phone', $phone)->first();
        if ($user) {
            $otp = $user->otp;
            if ($otp == $requestotp) {
                $user->otp = null;
                $user->save();
                return redirect()->route('resetpassword');
            } else {
                return redirect()->back()->with('error', 'Invalid OTP');
            }
        } else {
            return redirect()->back()->with('error', 'User not found');
        }
    }

    
    
    

}