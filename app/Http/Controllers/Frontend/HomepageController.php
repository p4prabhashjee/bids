<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use App\Models\Product;
use App\Models\Gallery;
use App\Mail\ResetPasswordMail;
use Redirect;
use App\Models\Auctiontype;



class HomepageController extends Controller
{
    public function homepage(Request $request)
    {
       $auctionTypesWithProductCount = AuctionType::withCount('products')->where('status', 1)->get();
       //p($auctionTypesWithProductCount);
        return view('frontend.homepage',compact('auctionTypesWithProductCount'));
    }
    public function productsByAuctionType($slug) {
        $auctionType = AuctionType::where('slug', $slug)->first();
        $products = Product::where('auction_type_id', $auctionType->id)->get();
    
        return view('frontend.products.index', ['products' => $products]);
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

    public function productlists(Request $request,$slug)
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
    
}
