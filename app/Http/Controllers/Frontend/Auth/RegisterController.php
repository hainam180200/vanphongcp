<?php

namespace App\Http\Controllers\Frontend\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
     /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

     use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:frontend');
    }
    protected function guard()
    {
        return Auth::guard('frontend');
    }
    public function showRegistrationForm()
    {
        return view('frontend.auth.register');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|min:4|max:30|unique:users,username|regex:/^([A-Za-z0-9_.])+$/i',
            'email' => 'required|unique:users,email|string|email|max:255',
            'phone' =>'required|unique:users,phone|digits_between:5,11',
            'password' => 'required|min:6|max:32|string|min:6|confirmed|different:username',

        ],[
            'username.min'      => 'Tên tài khoản ít nhất 4 ký tự.',
            'username.max'      => 'Tên tài khoản không quá 30 ký tự.',
            'username.unique'   => 'Tên tài khoản đã được sử dụng.',
            'username.required' => 'Vui lòng nhập tài khoản',
            'username.regex'    => 'Tên tài khoản không ký tự đặc biệt.',
            'email.required' => 'Vui lòng nhập email',
            'email.email'    => 'Địa chỉ email không đúng định dạng.',
            'email.unique'   => 'Địa chỉ email đã được sử dụng.',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min'      => 'Mật khẩu phải ít nhất 6 ký tự.',
            'password.max'      => 'Mật khẩu không vượt quá 32 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không đúng',
            'password.different' => 'Mật khẩu không được trùng với tài khoản',
            'phone.required'    => 'Vui lòng nhập số điện thoại',
            'phone.unique'      => 'Số điện thoại đã được đăng ký',
            'phone.digits'      => 'Số điện thoại không đúng định đạng',
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     *
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'account_type' => 2,
            'status' => 1,
        ]);
    }
}
