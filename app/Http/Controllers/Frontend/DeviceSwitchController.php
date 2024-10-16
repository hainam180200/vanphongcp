<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cookie;

class DeviceSwitchController extends Controller
{
    public function getSwitch(Request $request, $switch){
        if (strtolower($request->switch) == 'true') {
            Cookie::queue(Cookie::make('mobileswitch',true, 21600));
        }
        else if(strtolower($request->switch) == 'false'){
            Cookie::queue(Cookie::make('mobileswitch',false, 21600));
        }
        return redirect()->back();
    }
}
