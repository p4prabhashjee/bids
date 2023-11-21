<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Useraddress;
use App\Traits\ImageTrait;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Wishlist;


class DashboardController extends Controller
{
    use ImageTrait;

    public function userdashboard(Request $request)
    {
        $users = Auth::user();
        return view('frontend.dashboard.myaccount', compact('users'));
    }

    public function profileupdate(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required',
            'profile_image' => '',
        ]);
        $user = auth()->user();
        $user_id = $user->id;

        $todo = User::find($user_id);

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $this->verifyAndUpload($request, 'profile_image', $user->profile_image);
            $data['profile_image'] = asset('img/users/' . $data['profile_image']);
        }

        $todo->name = $request->name;
        $todo->username = $request->username;
        $todo->save();
        if ($todo) {
            return redirect()->route('userdashboard')->with('success', true);
        } else {
            return redirect()->route('userdashboard')->with('error', false);
        }
    }

    public function changepassword(Request $request)
    {
        // $users = Auth::user();
        return view('frontend.dashboard.change-password');
    }

    public function changePass(Request $request)
    {
        $rules = [
            'current_password' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.',
            ], 404);
        }

        if (Hash::check($request->current_password, $user->password)) {
            // Password match, proceed with updating the password
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('userdashboard')->with('success', true);

        } else {
            // Incorrect current password
            return redirect()->route('updateinfo')->with('error', 'Current password is incorrect.');
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('homepage');
    }

    // user Address

    public function useraddress(Request $request)
    {
        $userAddresses = Useraddress::where('user_id', auth()->user()->id)->get();

        return view('frontend.dashboard.useraddress', compact('userAddresses'));
    }

    // addaddress

    public function adduseraddress(Request $request)
    {
        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'apartment' => 'nullable|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'required|string',
            'is_save' => 'required|boolean',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $firstErrorMessage = $validator->errors()->first();
            return response()->json([
                'ResponseCode' => 422,
                'Status' => 'False',
                'Message' => $firstErrorMessage,
            ], 422);
        }

        $user = auth()->user();
        $userAddress = new Useraddress($request->all());
        $userAddress->user_id = $user->id;
        $userAddress->save();

        return redirect()->back()->with('success', 'User address added successfully');
    }

    // delete address

    public function delete($id)
    {
        $userAddress = Useraddress::find($id);

        if (!$userAddress) {
            return redirect()->route('user.addresses')->with('error', 'Address not found');
        }

        $userAddress->delete();

        return redirect()->back()->with('success', 'Address deleted successfully');
    }

    // edit update

    public function edit($id)
    {
        $address = UserAddress::find($id);

        return view('user.addresses.edit', compact('address'));
    }

    public function update(Request $request, $id)
    {
        $address = UserAddress::find($id);


        $address->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'apartment' => $request->input('apartment'),
            'city' => $request->input('city'),
            'country' => $request->input('country'),
            'state' => $request->input('state'),
            'zipcode' => $request->input('zipcode'),
        ]);

        return redirect('/user/addresses')->with('success', 'Address updated successfully.');
    }

    public function getwishlist(Request $request){
        if (Auth::check()) {
            $user = Auth::user();
            $wishlistItems = Wishlist::where('user_id', $user->id)->paginate(10);
            return view('frontend.products.wishlist', ['wishlistItems' => $wishlistItems]);
        }
        
        return view('frontend.products.wishlist'); 
    }

}
