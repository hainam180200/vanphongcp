<?php

namespace App\Http\Controllers\Api\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JWTAuth;
use Validator;

class LoginController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',

        ],[
            'username.required' => __("username không được để trống."),
            'password.required' => __("Bạn chưa mật khẩu."),

        ]);

        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => 0
            ],422);
        }

        $user = User::where('username', $request->username)
            ->where('status',1)
            ->where('account_type',1)
            ->select('id','username','email','fullname','balance','password')
            ->first();
        if(!$user){
            return response()->json([
                'message' => __('Tài khoản hoặc mật khẩu không đúng.'),
                'status' => 0
            ], 401);
        }

        if($user && \Hash::check($request->password,$user->password)){
            Cache::put('last_login', Carbon::now(), 1440);
            ActivityLog::create([
                'user_id'=> $user->id,
                'prefix' => 'frontend',
                'method'=> 'LOGIN',
                'url'=> \Request::fullUrl(),
                'description'=> 'Đã đăng nhập frontend thành công',
                'ip_address'=>$request->getClientIp(),
                'user_agent'=>isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'No User Agent'
            ]);
            $token = JWTAuth::fromUser($user);
            return response()->json([
                'message' => 'Đăng nhập thành công.',
                'status' => 1,
                'token' => $token,
                'exp_token' => 60 * 60,
                'user' => $user,
            ], 200);

        }else{
            return response()->json([
                'message' => __('Tài khoản hoặc mật khẩu không đúng.'),
                'status' => 0
            ], 401);
        }
    }
}
