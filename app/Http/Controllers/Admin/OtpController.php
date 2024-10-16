<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class OtpController extends Controller
{
    protected $page_breadcrumbs;
    //Thành viên
    protected $account_type=2;

    public function __construct()
    {
        //set permission to function
        $this->middleware('permission:user-otp');


        $this->page_breadcrumbs[] = [
            'page' => route('admin.user.index'),
            'title' => __("Thành viên")
        ];
    }

    public function index(){

        $roles=Role::orderBy('order','asc')->get();
        return view('admin.user.otp')->with('page_breadcrumbs', $this->page_breadcrumbs)
            ->with('roles',$roles);
    }

    public function postOtp(Request $request){
        if($request->ajax())
        {
            $email = $request->email;
            $otp = Otp::where('email','LIKE', '%' . $email . '%')->first();
            //$key = $otp->verify_code;
            return response()->json([
                "success"=> true,
                "status" => 1,
                "otp" => $otp,
            ], 200);
        }
    }
}
