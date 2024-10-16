<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
//use Illuminate\Contracts\Validation\Validator;
use App\Library\Helpers;
use App\Library\HelpersDevice;
use App\Library\MediaHelpers;
use App\Models\Comment;
use App\Models\Favourite;
use App\Models\Item;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Provinces;
use App\Models\User;
use App\Models\UserAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Meta;
use Validator;
use Illuminate\Support\Facades\Hash;




class UserController extends Controller

{
    public function getInfo()
    {
        $user = Auth::guard('frontend')->user();

        $user_meta =  $user->getAllMeta();

        $q = User::where('id','=',$user->id);
        $data = Order::where('author_id',$user->id)->where('module','order')->get();
        $comment = Comment::with('item')->with('user')->where('author_id',$user->id)->get();
        $favorite = Favourite::with('item')->with('user')->where('user_id',$user->id)->where('status','1')->get();
//        $detail = OrderDetail::where('order_id',$data->id)->get();



        return view('frontend.pages.account.index')
            ->with('user', $user)->with('user_meta', $user_meta)->with('data', $data)->with('comment', $comment)->with('favorite',$favorite);
    }
    public function getProfile()
    {
        $user = Auth::guard('frontend')->user();

        $user_meta =  $user->getAllMeta();

        $q = User::where('id','=',$user->id);
        $dataDistrict = Provinces::with('districts')->get();


//        dd($user);
        //return $user;
        return view('frontend.pages.account.info')
        ->with('user', $user)->with('user_meta', $user_meta)->with('dataDistrict',$dataDistrict);
    }
    public function getFavorite()
    {
        $user = Auth::guard('frontend')->user();

        $favorite = Favourite::with('item')->with('user')->where('user_id',$user->id)->where('status','1')->get();

        return view('frontend.pages.account.wishlist')
            ->with('user', $user)->with('favorite',$favorite);
    }
    public function postImage(Request $request)
    {

        $user = Auth::guard('frontend')->user();
        $user_meta =  $user->getAllMeta();

        $q = User::where('id','=',$user->id);
        if ($request->cover_mobile) {

            $avatar = MediaHelpers::upload_image($request->cover_mobile,'images',null,null,null,false);
            $user->image = $avatar;
            $user->save();

            return response()->json(['status' => true]);
        }

    }
    public function postProfile(Request $request)
    {
        $user = Auth::guard('frontend')->user();

        $validator = Validator::make($request->all(), [
            'username' => 'required',
//            'username' => 'required',
//            'email' => 'required|email',
        ],[
            'username.required' => "Vui lòng nhập họ tên",
            'email.required' => "Email không được để trống",
        ]);

        if ($validator->fails()) {
            redirect()->back()->withErrors($validator->errors()->first());
//            return response()->json(['message' => $validator->errors()->first(),'status' => 0]);
//            return redirect()->route('getProfile')->with('user', $user);
        }else{
            $input = [
                'address' => $request->address,
                'username' => $request->username,
                'phone' => $request->phone,
                'birtday' => $request->birtday,
            ];
            $user->update($input);
        }
        if ($request->input("password")){
            $validator2 = Validator::make($request->all(), [
                'password' => 'min:6|max:32|string|min:6|confirmed|different:username',
            ],[
                'password.min'      => 'Mật khẩu phải ít nhất 6 ký tự.',
                'password.max'      => 'Mật khẩu không vượt quá 32 ký tự.',
                'password.confirmed' => 'Mật khẩu xác nhận không đúng',
                'password.different' => 'Mật khẩu không được trùng với tài khoản',
            ]);
            if ($validator2->fails()) {

                return redirect()->back()->withErrors($validator2->errors()->first());
//                return response()->json(['message' => $validator2->errors()->first(),'status' => 0]);
//            return redirect()->route('getProfile')->with('user', $user);
            }else{

                $inputPassword = [
                    'password' => Hash::make($request->password),
                ];
                $user->update($inputPassword);
            }

        }



        if ($request->filled('CompanyName')){
            $user->setMeta('CompanyName', $request->CompanyName);
        }
        if ($request->filled('provinces')){
            $user->setMeta('provinces', $request->provinces);
        }
        if ($request->filled('CompanyAddress')){
            $user->setMeta('CompanyAddress', $request->CompanyAddress);
        }
        if ($request->filled('CompanyID')){
            $user->setMeta('CompanyID', $request->CompanyID);
        }



        return redirect()->route('getProfile')->with('user', $user);
    }
    public function getOrderDetail(Request $request, $id){
//        if (isset($id)){
            $user = Auth::guard('frontend')->user();
            $data = Order::where('author_id',$user->id)->where('module','order')->where('id',$id)->where('status_confirm',1)->firstOrFail();
            $detail = OrderDetail::where('order_id',$data->id)->get();

            if(HelpersDevice::isMobile()) {
                return view('frontend.pages.account.mobile.order',compact('data','detail'));
            }
            else{
                return view('frontend.pages.account.desktop.order',compact('data','detail'));
            }

    }
    public function getOrder(){
        $user = Auth::guard('frontend')->user();
        $data = Order::where('author_id',$user->id)->where('module','order')->get();


        if(HelpersDevice::isMobile()) {
            return view('frontend.pages.account.mobile.order',compact('data'));
        }
        else{
            return view('frontend.pages.account.desktop.order',compact('data'));
        }
    }

    public function postUserFavourite(Request $request, $id){
        $user = Auth::guard('frontend')->user();

        $item = Item::where('status',1)->where('id',$id)->first();
        if(!$item){
            return response()->json([
                'status'=>0,
                'message'=>__('Không tìm thấy sản phẩm !')
            ]);
        }

        // check xem sảm phẩm này đã có trạng thái thích trong bảng action hay chưa

        $action = Favourite::where('user_id',$user->id)->where('item_id',$item->id)->first();

        // trường hợp chưa có, thì thêm mới và để trạng thái là đang theo dõi

        if(!$action){
            $data = Favourite::create([
                'user_id' => $user->id,
                'item_id' => $item->id,
                'status' => 1,

            ]);

            return response()->json([
                'status'=> 1,
                'favourite' => true,
            ]);
        }
        // trường hợp đã có action follow của user, kiểm tra xem đang ở trạng thái nào và update ngược lại
        // trường hợp đang thích, sẽ update ngươc lại không thích
        if($action->status == 1){
            $action->status = 0;
            $action->save();
            return response()->json([
                'status'=> 1,
                'favourite' => false,
            ]);
        }
        // trường hợp này là đang bỏ thích, hành động này sẽ tạo thích lại cho idol
        else if($action->status == 0){
            $action->status = 1;
            $action->save();
            return response()->json([
                'status'=> 1,
                'favourite' => true,
            ]);
        }
        // trường hợp không xác định, return lỗi không xác định
        else{
            return response()->json([
                'status'=>0,
                'message'=>__('Có lỗi phát sinh, vui lòng liên hệ QTV để xử lý !')
            ]);
        }

    }
}
