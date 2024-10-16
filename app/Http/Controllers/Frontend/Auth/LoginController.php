<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Cache;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Contracts\Provider;
use Socialite;
use App\Models\SocialAccount;
use Log;
use Session;

class LoginController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	*/
	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */

	protected $redirectTo = '/';

	protected $redirectAfterLogout = '/';

	protected $maxAttempts=6;
	protected $decayMinutes=2;


    public function __construct()
	{
		$this->middleware('guest:frontend')->except('logout');
	}

    public function showLoginForm()
	{
		session(['link' => url()->previous()]);
		return view('frontend.pages.auth.login');
	}
	// override field login
	public function username()
	{
		$login = request()->input('username');
		$field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
		request()->merge([$field => $login]);
		return $field;
	}
	protected function validateLogin(Request $request)
	{
		$this->validate($request, [
			'username' => 'required|string',
			'password' => 'required|string',
		], [
			"username.required" => "Bạn chưa nhập tài khoản",
			"password.required" => "Bạn chưa nhập mật khẩu",
		]);
	}
	protected function attemptLogin(Request $request)
	{
		$user = User::where($this->username(), $request->username)
			->where('status',1)
			->where('account_type',2)
			->first();
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

			return $this->guard()->attempt(
				$this->credentials($request), $request->filled('remember')
			);
		}
		return false;
	}
	protected function authenticated(Request $request, $user)
    {
        return redirect(session('link'));
    }
	protected function guard()
	{
		return Auth::guard('frontend');
	}
	public function logout(Request $request)
	{
        ActivityLog::create([
            'user_id'=> Auth::guard('frontend')->user()->username,
			'prefix' => 'frontend',
            'method'=> 'LOGIN',
            'url'=> \Request::fullUrl(),
            'content'=> 'Đã đăng xuất frontend thành công',
            'ip_address'=>$request->getClientIp(),
            'user_agent'=>isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'No User Agent'
        ]);
        $this->guard('frontend')->logout();
		return $this->loggedOut($request) ?: redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
	}
	public function LoginFacebook(Request $request){
		
		return Socialite::driver('facebook')->stateless()->redirect();
	}

	public function CallbackSocial(Request $request,$provider){
		if(Auth::guard('frontend')->check()){
			return redirect(session('link'));
		}
		$infoCode = base64_decode(base64_decode($request->code));
        $info = explode("||", $infoCode);
		$user = $this->FindOrCreateUser($info,$provider);
		if($user === -1){
			return 'user -1';
		}

		if($user === 999){
			return 'user 999';
		}

		Auth::guard('frontend')->login($user, true);

		return redirect(session('link'));
	}

	function FindOrCreateUser($info,$provider){
		try{
			$account = SocialAccount::where('provider',$provider)->where('provider_user_id',$info[0])->first();
			if($account){
				$user = User::where('id',$account->user_id)->where('account_type',2)->where('status',1)->first();
				if(!$user){
					$user = User::create([
						'username' => 'facebook@'.$info[0],
						'fullname' => $info[1],
						'account_type' => 2,
						'provider_id' => $info[0],
						'status' => 1,
					]);
				}
				return $user;
			}

			$user = User::create([
				'username' => 'facebook@'.$info[0],
				'fullname' => $info[1],
				'account_type' => 2,
				'provider_id' => $info[0],
				'status' => 1,
			]);

			$socialAccount= SocialAccount::create([
				'user_id' => $user->id,
				'provider_user_id' => $info[0],
				'provider' => $provider
			]);
			return $user;
		}
		catch (\Exception $e) {
			Log::error($e);
			return 999;
		}
	}

}
