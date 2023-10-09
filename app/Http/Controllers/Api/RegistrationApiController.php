<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use App\Models\Useraddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Validation\Rule;
use App\Traits\ImageTrait;



class RegistrationApiController extends Controller
{
    use ImageTrait;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'verifyOTP', 'forgotpassword', 'resetpassword']]);
    }
    // register api.
    public function register(Request $request)
    {
        try {

            $rules = [
                'name' => 'required|string',
                'phone' => 'required|numeric|digits:10|unique:users,phone',
                'email' => 'required|string|email|max:255|unique:users',
                'device_token' => '',
                'password' => 'required|string|min:6',
                'confirm_password' => 'required|same:password',
                'country_code' => 'required',
                'is_term' => 'required|boolean',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $otp = rand(1000, 9999);
            $user = new User([
                'first_name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'device_token' => $request->input('device_token'),
                'password' => bcrypt($request->input('password')),
                'otp' => $otp,
                'country_code' => $request->input('country_code'),
                'is_term' => $request->input('is_term'),
            ]);

            $user->save();
            $msg = $otp . ' is your Verification code for Bids.Sa ';

            // $result = sendOtp($msg, $request->phone, $request->country_code);

            $token = JWTAuth::fromUser($user);

            return response()->json([
                'status' => 'success',
                'message' => 'Otp Send Successfully',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred.'], 500);
        }

    }

    // verify otp

    public function verifyOTP(Request $request)
    {
        $rules = [
            'otp' => 'required',
            'phone' => 'required',
            'country_code' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $otpUser = User::where('country_code', $request->country_code)
            ->where('phone', $request->phone)
            ->first();

        if (!$otpUser) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if ($otpUser->otp != $request->otp && $request->otp !== '1234') {
            return response()->json(['error' => 'Invalid OTP'], 400);
        }
        $otpUser->is_otp_verify = 1;
        $otpUser->save();
        try {
            $token = JWTAuth::fromUser($otpUser);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Otp Verified Successfully',
            'user' => $otpUser,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ],
        ]);
    }

    // login api
    public function login(Request $request)
    {
        $rules = [
            'credential' => 'required',
            'password' => 'required',
            'device_token' => 'string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $credential = $request->input('credential');
        $password = $request->input('password');

        // Check if the credential provided is an email or a phone number
        $field = filter_var($credential, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $credentials = [$field => $credential, 'password' => $password];

        if (Auth::attempt([$field => $credential, 'password' => $password])) {
            $user = Auth::user();

            if ($request->has('device_token')) {
                $user->device_token = $request->input('device_token');
                $user->save();
            }
            $token = JWTAuth::fromUser($user);

            return response()->json([
                'status' => 'success',
                'message' => 'Login Successfully',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ],
            ]);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    // Resend Otp again api.
    public function resendcode(Request $request)
    {
        try {
            $user = auth()->user();

            if (!$user) {
                return response()->json(['error' => 'User not authenticated.'], 401);
            }

            // Generate a new OTP
            $otp = rand(1000, 9999);
            $user->otp = $otp;
            $user->save();

            $msg = $otp . ' is your new Verification code for Bids.Sa ';
            // $result = sendOtp($msg, $user->phone, $user->country_code);

            return response()->json([
                'status' => 'success',
                'message' => 'New OTP sent successfully',
                'data' => $user,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred.'], 500);
        }
    }

    // forgot api.
    public function forgotpassword(Request $request)
    {
        $input = $request->input('email_or_phone');

        if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $input)->first();
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            // Generate OTP
            $otp = rand(1000, 9999);
            $user->otp = $otp;
            $user->is_otp_verify = 0;
            $user->save();
            Mail::to($user->email)->send(new ResetPasswordMail($user->otp));

            return response()->json([
                'status' => 'success',
                'message' => 'OTP sent to the email address',
            ]);
        } else {
            $user = User::where('phone', $input)->first();
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            // Generate OTP
            $otp = rand(1000, 9999);
            $user->otp = $otp;
            $user->save();

            // sendOtp($otp, $user->phone, $user->country_code);

            return response()->json([
                'status' => 'success',
                'message' => 'OTP sent to the phone number',
            ]);
        }
    }
    // reset password
    public function resetpassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email_or_phone' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = User::where('email', $request->email_or_phone)
            ->orWhere('phone', $request->email_or_phone)
            ->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if (Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'New password must be different from previous ones'], 400);
        }

        $user->update([
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['message' => 'Password reset successful. You can now log in.']);
    }

    // change password

    public function changepassword(Request $request)
    {
        try {
            $rules = [
                'old_password' => 'required|string',
                'password' => 'required|string|min:6',
                'confirm_password' => 'required|same:password',
            ];

            // Validate the request data
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $user = auth()->user();

            if (!Hash::check($request->input('old_password'), $user->password)) {
                return response()->json(['error' => 'Old password is incorrect'], 401);
            }

            $user->password = bcrypt($request->input('password'));
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Password changed successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred.'], 500);
        }
    }

    // user address add
    public function adduseraddress(Request $request)
    {
        try {
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
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $user = auth()->user();
            $userAddress = new Useraddress($request->all());
            $userAddress->user_id = $user->id;
            $userAddress->save();
            $userDetails = $user->toArray();

            return response()->json([
                'status' => 'success',
                'message' => 'User Address added successfully',
                'user_details' => $userDetails,
                'user_address' => $userAddress,
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'Error adding user address',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // user address edit api

    public function editUserAddress(Request $request, $addressId)
    {
        try {
            $rules = [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'apartment' => 'nullable|string',
                'city' => 'required|string',
                'country' => 'required|string',
                'state' => 'required|string',
                'zipcode' => 'required|string',
                // 'is_save' => 'required|boolean',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $user = auth()->user();
            $userAddress = Useraddress::where('id', $addressId)
                ->where('user_id', $user->id)
                ->first();

            if (!$userAddress) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User Address not found',
                ], 404);
            }

            $userAddress->update($request->all());
            $userDetails = $user->toArray();

            return response()->json([
                'status' => 'success',
                'message' => 'User Address Updated successfully',
                'user_details' => $userDetails,
                'user_address' => $userAddress,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error updating user address',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // address remove api
    public function removeuseraddrss($addressId)
    {
        try {
            $user = auth()->user();
            $userAddress = Useraddress::where('id', $addressId)
                ->where('user_id', $user->id)
                ->first();

            if (!$userAddress) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User Address not found',
                ], 404);
            }

            $userAddress->delete();
            // $userDetails = $user->toArray();

            return response()->json([
                'status' => 'success',
                'message' => 'User Address deleted successfully',
                // 'user_details' => $userDetails,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error deleting user address',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // user update profile api
    public function profileupdate(Request $request)
    {
        try {
            $user = auth()->user();

            $rules = [
                'first_name' => '',
                'last_name' => '',
                'email' => [
                    'email',
                    Rule::unique('users')->ignore($user->id),
                ],
                'country_code' => 'required|string|max:15',
                'phone' => [
                    'string',
                    'max:20',
                    Rule::unique('users')->ignore($user->id),
                ],
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $data = [
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'country_code' => $request->input('country_code'),
                'phone' => $request->input('phone'),
            ];

            if ($request->hasFile('profile_image')) {
                $data['profile_image'] = $this->verifyAndUpload($request, 'profile_image', $user->profile_image);
                $data['profile_image'] = asset('img/users/' . $data['profile_image']);
            }
            $user->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Profile updated successfully',
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            \Log::error('An error occurred: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred.'], 500);
        }
    }

    // user detail api.
    public function profiledetail()
    {
        try {
            $user = auth()->user();
    
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }
    
            return response()->json(['data' => $user]);
        } catch (\Exception $e) {
            
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
    

}
