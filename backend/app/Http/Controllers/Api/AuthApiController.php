<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\VerificationCode;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthApiController extends BaseApiController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ]);

        if($validator->fails()){
            return sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['user'] =  $user;

        return sendResponse(data:$success, message:'User register successfully.');
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['email'] =  $user->email;

            return sendResponse(data:$success, message:'User login successfully.');
        }
        else{
            return sendError(message:'Unauthorised.',data: ['error'=>'Unauthorised']);
        }
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success' => __('locale.successfully_logged_out')
        ],  200);
    }

    public function logout_all_devices(Request $request)
    {
        try {
            auth()->user()->tokens()->delete();
            return sendResponse([
                'success'=> __('locale.successfully_logged_out_from_all_devices')
            ],200);
        } catch (Exception $e) {
            return sendError(message:$e->getMessage(), code:$e->getCode());
        }


    }



    //login by telegram
    //App/Telegram/Handler
    // https://defstudio.github.io
    // public function login(Request $request)
    // {
    //     $validator = Validator::make($request->all(),[
    //         // 'user_id' => 'required|integer',
    //         'sms_code' => 'required|integer'
    //     ]);

    //     if ($validator->fails()) {
    //         return $this->sendError($validator->errors(),'error validation');
    //     }

    //     $verificationCode = VerificationCode::query()
    //         // ->where('user_id', $request->user_id)
    //         ->where('sms_code', $request->sms_code)
    //         ->first();

    //     if (!$verificationCode) {
    //         return $this->sendError('Your code is not correct');
    //     }elseif($verificationCode && now()->isAfter($verificationCode->expire_at)){
    //         return $this->sendError('Your code has been expired');
    //     }

    //     $user = User::findOrFail($verificationCode->user_id);
    //     $user->status = 1;
    //     $user->phone_number_confirmed_at = now();
    //     $pswd = $request->phone_number.'$12345678$';
    //     $user->password = bcrypt($pswd);
    //     $user->save();

    //     if(Auth::attempt(['phone_number' => $user->phone_number, 'password' => $pswd]))
    //     {
    //         $authuser = Auth::user();
    //         $success['token'] =  $user->createToken('authToken',[
    //             // $authuser->role->name
    //         ])->plainTextToken;
    //         $success['user'] = $authuser;

    //         $data = [
    //             'success' => true,
    //             'message' => __('locale.user_login_successfully'),
    //             'data' => $success
    //         ];

    //         return $this->sendResponse($success,__('locale.user_login_successfully'));

    //     }

    // }


}
