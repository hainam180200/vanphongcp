<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{



	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
        $this->page_breadcrumbs[] = [
            'page' => route('admin.profile'),
            'title' => __("Thông tin cá nhân")
        ];

	}


	public function profile(){

        return view('admin.profile.index')->with('page_breadcrumbs',$this->page_breadcrumbs);
    }



    public function getChangeCurrentPassword()
    {
        return view('admin.profile.index')->with('tab',1);
    }

    public function postChangeCurrentPassword(Request $request){
        $user = User::findOrFail(Auth::user()->id);
        if(Hash::check($request->old_password,$user->password)){
            $user->password=Hash::make($request->password);
            $user->save();
            Auth::login($user);
            return redirect()->back()->with('tab',1)->with('success', trans( 'Đổi mật khẩu thành công'));
        }
        else{
            return redirect()->back()->withErrors(trans('Mật khẩu cũ không đúng'));
        }
    }


}
