<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthBackendController extends Controller
{
//    public function showRegisterForm()
//    {
//        return view('backend.auth.register');
//    }
//
//    public function register(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'name' => 'required|string|max:255',
//            'email' => 'required|email|unique:users,email',
//            'password' => 'required|string|min:8|confirmed',
//        ]);
//
//        if($validator->fails()){
//            return redirect()->back()->with('error', $validator->errors())->withInput();
//        }
//
//        $user = User::create([
//            'username' => $request->username,
//            'email' => $request->email,
//            'password' => Hash::make($request->password),
//        ]);
//
//        Auth::login($user);
//
//        return redirect()->route('backend.index'); // Redirect to the user dashboard after registration
//    }

    public function showLoginForm()
    {
        return view('backend.auth.login');
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->with('error', $validator->errors())->withInput();
            // return response()->json([
            //     'error' => true,
            //     'message' => $validator->errors()
            // ]);

        }
        // $credentials = $request->only('email', 'password');
        $remember_me = $request->has('remember') ? true : false;

        //remember me ning expire timeni o'rnatish
        // Auth::setRememberDuration(43200);  43200 minutes (30 days * 24 hours * 60 minutes)

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password], $remember_me))
        {
            return redirect()->route('backend.index');
        }

        return redirect()->route('backend.auth.login')->with('error', 'Invalid login credentials.');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('backend.auth.login'); // Redirect to the login page after logout
    }

}
