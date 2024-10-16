<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Group_Item;
use App\Models\SubItem;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Wards;
use App\Models\Districts;
use App\Models\Provinces;
use ArrayObject;
use App\Library\HelpersDevice;
use function GuzzleHttp\json_decode;
use Cookie;
use Auth;
use App\Library\Helpers;
use DB;
use Validator;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function getCheckout(Request $request, $id){
        $user = Auth::guard('frontend')->user();
        $data = Order::where('author_id',$user->id)->where('module','order')->where('id',$id)->where('status_confirm',2)->firstOrFail();
        $detail = OrderDetail::where('order_id',$data->id)->get();
        if(HelpersDevice::isMobile()) {
            return view('frontend.pages.mobile.checkout',compact('data','detail'));
        }
        else{
            return view('frontend.pages.desktop.checkout',compact('data','detail'));
        }
    }
    public function postCheckout(Request $request,$id){
        $user = Auth::guard('frontend')->user();
        $data = Order::where('author_id',$user->id)->where('module','order')->where('status_confirm',2)->where('id',$id)->firstOrFail();
        $data->status_confirm = 1;
        $data->save();
        $username = $user->fullname??$user->username;
        $text = "Thông báo từ ".\Request::getHost().": Tài khoản ".$username." vừa đặt đơn hàng. Mã đơn: #".$data->id;
        Helpers::TelegramNotify($text);
        return redirect()->to('/order/success/'.$data->id);
    }

    public function orderSuccess(Request $request, $id){
        $user = Auth::guard('frontend')->user();
        $data = Order::where('author_id',$user->id)->where('module','order')->where('id',$id)->where('status_confirm',1)->firstOrFail();
        $detail = OrderDetail::where('order_id',$data->id)->get();
        if(HelpersDevice::isMobile()) {
            return view('frontend.pages.mobile.order_success',compact('data','detail'));
        }
        else{
            return view('frontend.pages.desktop.order_success',compact('data','detail'));
        }
    }

    public function getOrder(Request $request, $id){
        $user = Auth::guard('frontend')->user();
        $data = Order::where('author_id',$user->id)->where('module','order')->where('id',$id)->where('status_confirm',1)->firstOrFail();
        $detail = OrderDetail::where('order_id',$data->id)->get();
        if(HelpersDevice::isMobile()) {
            return view('frontend.pages.mobile.checkout',compact('data','detail'));
        }
        else{
            return view('frontend.pages.desktop.checkout',compact('data','detail'));
        }
    }


    public function postOrder(Request $request){
        $this->validate($request,[
            'fullname'=>'required',
            'phone'=>'required',
            'provinces'=>'required',
            'districts'=>'required',
            'address'=>'required',
            'email'=>'required',
        ],[
            'fullname.required' => __('Vui lòng nhập tên đầy đủ'),
            'phone.required' => __('Vui lòng nhập số điện thoại'),
            'provinces.required' => __('Vui lòng chọn thành phố'),
            'districts.required' => __('Vui lòng chọn quận huyện'),
            'address.required' => __('Vui lòng nhập địa chỉ cụ thể'),
            'email.required' => __('Vui lòng nhập email'),
        ]);

        // tìm sản phẩm
        if (!Cookie::has('shopping_cart')){
            return redirect()->back()->withErrors('Bạn không có sản phẩm nào trong giỏ hàng để thực hiện thao tác này !');
        }
        $cart = collect(json_decode(Cookie::get('shopping_cart')));
        $id_item = $cart->pluck('id')->toArray();
        $id_item = array_unique($id_item);
        $data_item = Item::where('module', '=','product')->whereIn('id',$id_item)->get();
        foreach($data_item as $aItem){
            foreach($cart as $key => $aCart){
                if($aCart->id==$aItem->id){
                    $aCart->price = $aItem->price;
                    $aCart->price_base = $aItem->price_old;
                    $aCart->promotion = $aItem->promotion;
                    $aCart->image = $aItem->image;
                    $options_content = [];
                    if(isset($aCart->options)){
                        $options = $aCart->options;
                        $options = json_decode(json_encode($options), true);
                        $getIdNameAtt = array_keys($options);
                        $getObjNameAtt = Item::where('module','=','product-attribute')
                        ->whereIn('id',$getIdNameAtt)
                        ->where('type',1)
                        ->get();
                        $getObjValAtt = $aItem->subitem;
                        foreach($getObjNameAtt as $key_name_att => $item_aNameAtt){
                            foreach($getObjValAtt as $key_val_att => $item_aValAtt){
                                foreach($options as $key_options => $item_options){
                                    if($key_options == $item_aNameAtt->id && $item_options == $item_aValAtt->id){
                                        $options_content[] = [
                                            'name' => $item_aNameAtt->title,
                                            'val' => $item_aValAtt->content,
                                        ];
                                    }
                                }
                            }
                        }

                    }
                    $aCart->options_content = $options_content;
                }
            }
        }
        $total = [];
        $total_base = [];
        $count = [];
        foreach($cart as $item){
            $total[] = $item->price * $item->qty;
            $total_base[] = $item->price_base * $item->qty;
            $count[] = $item->qty;
        }
        $total = array_sum($total);
        $total_base = array_sum($total_base);
        $count = array_sum($count);
        $order = Order::create([
            'module' => 'order',
            'author_id' => Auth::guard('frontend')->user()->id,
            'price' => $total_base,
            'real_received_price' => $total,
            'type' => 1,
            'content' => $request->note,
            'status' => 2,
            'status_confirm' => 2,
        ]);

        $order_detail = array();
        $order_detail = [
            [
                'module' => 'fullname',
                'value' => $request->fullname
            ],
            [
                'module' => 'phone',
                'value' => $request->phone
            ],
            [
                'module' => 'provinces',
                'value' => $request->provinces
            ],
            [
                'module' => 'districts',
                'value' => $request->districts
            ],
            [
                'module' => 'address',
                'value' => $request->address
            ],
            [
                'module' => 'email',
                'value' => $request->email
            ],
        ];

        for($i = 0;$i < count($order_detail); $i++){
            OrderDetail::create([
                'module' => $order_detail[$i]['module'],
                'order_id' => $order->id,
                'value' => $order_detail[$i]['value'],
            ]);
        }

        foreach($cart as $item){
            OrderDetail::create([
                'module' => 'product',
                'order_id' => $order->id,
                'item_id' => $item->id,
                'quantity' => $item->qty,
                'value' =>json_encode($item->options,JSON_UNESCAPED_UNICODE),
            ]);
        }
        Cookie::queue(Cookie::forget('shopping_cart'));
        return redirect()->to('/check-out/'.$order->id);
    }
    public function postOrderNow(Request $request,$id){
        try{
            $validator = Validator::make($request->all(),[
                'fullname'=>'required',
                'phone'=>'required',
                'provinces'=>'required',
                'districts'=>'required',
                'address'=>'required',
                'email'=>'required',
                'quantity'=>'required',
            ],[
                'fullname.required' => __('Vui lòng nhập tên đầy đủ'),
                'phone.required' => __('Vui lòng nhập số điện thoại'),
                'provinces.required' => __('Vui lòng chọn thành phố'),
                'districts.required' => __('Vui lòng chọn quận huyện'),
                'address.required' => __('Vui lòng nhập địa chỉ cụ thể'),
                'email.required' => __('Vui lòng nhập email'),
                'quantity.required' => __('Vui lòng nhập số lượng'),
            ]);
            if($validator->fails()){
                return response()->json(['message' => $validator->errors()->first(),'status' => 0]);
            }
            $quantity = (int)$request->quantity;
            if($quantity < 1 || $quantity > 20){
                return response()->json([
                    'status' => 0,
                    'message' => "Số lượng không hợp lệ.",
                ]);
            }
            $data = Item::with('groups')->where('module','=','product')
            ->where('id',$id)
            ->where('status',1)
            ->first();
            if(!$data){
                return response()->json([
                    'status' => 0,
                    'message' => "Sản phẩm đặt mua không hợp lệ.",
                ]);
            }
            // check opstion
            $options = $request->options;
            if(isset($options)){
                foreach($options as $key_op => $item_op){
                    $data_item_op = Item::where('module','=','product-attribute')
                    ->where('id',$key_op)
                    ->where('status',1)
                    ->first();
                    if(!$data_item_op){
                        return response()->json([
                            'status' => 0,
                            'message' => "Thông số không hợp lệ.",
                        ]);
                    }
                    $data_item_att_op = SubItem::where('module','=','product_attribute')
                    ->where('id',$item_op)
                    ->where('status',1)
                    ->first();
                    if(!$data_item_att_op){
                        return response()->json([
                            'status' => 0,
                            'message' => "Thông số không hợp lệ.",
                        ]);
                    }
                }
            }
            $total_base = $data->price * $quantity;
            $total = $data->price_old * $quantity;
            $order = Order::create([
                'module' => 'order',
                'author_id' => Auth::guard('frontend')->user()->id,
                'price' => $total_base,
                'real_received_price' => $total,
                'type' => 1,
                'content' => $request->note,
                'status' => 2,
                'status_confirm' => 2,
            ]);
            $order_detail = array();
            $order_detail = [
                [
                    'module' => 'fullname',
                    'value' => $request->fullname
                ],
                [
                    'module' => 'phone',
                    'value' => $request->phone
                ],
                [
                    'module' => 'provinces',
                    'value' => $request->provinces
                ],
                [
                    'module' => 'districts',
                    'value' => $request->districts
                ],
                [
                    'module' => 'address',
                    'value' => $request->address
                ],
                [
                    'module' => 'email',
                    'value' => $request->email
                ],
            ];

            for($i = 0;$i < count($order_detail); $i++){
                OrderDetail::create([
                    'module' => $order_detail[$i]['module'],
                    'order_id' => $order->id,
                    'value' => $order_detail[$i]['value'],
                ]);
            }
            OrderDetail::create([
                'module' => 'product',
                'order_id' => $order->id,
                'item_id' => $data->id,
                'quantity' => $quantity,
                'value' =>json_encode($options,JSON_UNESCAPED_UNICODE),
            ]);
            return response()->json([
                'status' => 1,
                'message' => 'Thành công.',
                'redirect' => true,
                'url' => '/check-out/'.$order->id,
            ]);

        }
        catch(\Exception $e){
            Log::error($e);
            return response()->json([
                'status' => 0,
                'message' => "Có lỗi phát sinh, vui lòng thử lại.",
            ]);
        }
    }

    public function postOrderInstallment(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'fullname'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'month'=>'required',
            'prepaid_percentage'=>'required',
        ],[
            'fullname.required' => __('Vui lòng nhập tên đầy đủ'),
            'phone.required' => __('Vui lòng nhập số điện thoại'),
            'email.required' => __('Vui lòng nhập email'),
            'month.required' => __('Dữ liệu bị thiếu'),
            'prepaid_percentage.required' => __('Dữ liệu bị thiếu'),
        ]);
        if($validator->fails()){
            return response()->json(['message' => $validator->errors()->first(),'status' => 0]);
        }
        $data = Item::with('groups')->where('module','=','product')
        ->where('id',$id)
        ->where('status',1)
        ->first();
        if(!$data){
            return response()->json([
                'status' => 0,
                'message' => "Sản phẩm không tồn tại.",
            ]);
        }
        $checkOrder = Order::where('module','installment')->where('status',2)->where('author_id',Auth::guard('frontend')->user()->id)->first();
        if($checkOrder){
            return response()->json([
                'status' => 0,
                'message' => "Yêu cầu trước của bạn chưa được xử lý, vui lòng đợi.",
            ]);
        }
        $total_base = $data->price;
        $total = $data->price_old;
        $order = Order::create([
            'module' => 'installment',
            'author_id' => Auth::guard('frontend')->user()->id,
            'ref_id' => $data->id,
            'price' => $total_base,
            'real_received_price' => $total,
            'content' => $request->note,
            'status' => 2,
        ]);
        $order_detail = array();
        $order_detail = [
            [
                'module' => 'fullname',
                'value' => $request->fullname
            ],
            [
                'module' => 'phone',
                'value' => $request->phone
            ],
            [
                'module' => 'email',
                'value' => $request->email
            ],
            [
                'module' => 'month',
                'value' => $request->month
            ],
            [
                'module' => 'prepaid_percentage',
                'value' => $request->prepaid_percentage
            ],
        ];
        for($i = 0;$i < count($order_detail); $i++){
            OrderDetail::create([
                'module' => $order_detail[$i]['module'],
                'order_id' => $order->id,
                'value' => $order_detail[$i]['value'],
            ]);
        }
        OrderDetail::create([
            'module' => 'product',
            'order_id' => $order->id,
            'item_id' => $data->id,
            'quantity' => 1,
            'value' =>null,
        ]);
        $username = Auth::guard('frontend')->user()->fullname??Auth::guard('frontend')->user()->username;
        $text = "Thông báo từ ".\Request::getHost().": Tài khoản ".$username." vừa gửi yêu cầu trả góp. Mã đơn: #".$order->id;
        Helpers::TelegramNotify($text);
        return response()->json([
            'status' => 1,
            'message' => "Gửi yêu cầu thành công.",
        ]);
    }


}
