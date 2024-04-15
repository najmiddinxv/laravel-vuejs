<?php

namespace App\Http\Controllers\Frontend\UserProfile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthProfileController extends Controller
{

    public function showRegisterForm()
    {
        return view('frontend.userProfile.auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if($validator->fails()){
            return redirect()->back()->with('error', $validator->errors())->withInput();
        }

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('userProfile.auth.login'); // Redirect to the user dashboard after registration
    }

    public function showLoginForm()
    {
        return view('frontend.userProfile.auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->with('error', $validator->errors())->withInput();

        }
        $remember_me = $request->has('remember') ? true : false;

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials, $remember_me))
        {
            return redirect()->route('userProfile.index'); // Redirect to the user dashboard after login
        }

        return redirect()->route('userProfile.auth.login')->with('error', 'Invalid login credentials.');

    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        // return redirect()->route('userProfile.auth.login'); // Redirect to the login page after logout
        return redirect()->route('frontend.index'); // Redirect to the login page after logout
    }
}
