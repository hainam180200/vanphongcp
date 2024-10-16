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

class CartController extends Controller
{
    public function getCart(Request $request){
        $cart = null;
        $total = 0;
        $total_base = 0;
        $count = 0;
        if (Cookie::has('shopping_cart')){
            $cart = collect(json_decode(Cookie::get('shopping_cart')));
            if(count($cart) > 0){
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
                        Cookie::queue(Cookie::make('shopping_cart',json_encode($cart), 21600));
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
            }
        }
        if(HelpersDevice::isMobile()) {
            return view('frontend.pages.mobile.cart',compact('cart','total','total_base','count'));
        }
        else{
            return view('frontend.pages.desktop.cart',compact('cart','total','total_base','count'));
        }
    }
    public function addCart(Request $request, $id){
        try{
            if($request->quantity){
                $qty = $request->quantity;
                if(isset($qty) && (int)$qty < 1){
                    return response()->json([
                        'status' => 0,
                        'message' => "Số lượng không hợp lệ.",
                    ]);
                }
            }
            else{
                $qty = 1;
            }
            $data = Item::where('module','=','product')
            ->where('id',$id)
            ->where('status',1)
            ->first();
            if(!$data){
                return response()->json([
                    'status' => 0,
                    'message' => "Sản phẩm không hợp lệ.",
                ]);
            }
            // lấy tất cả các thuộc tính sản phẩm
            $attribute_id = $data->subitem->pluck('attribute_id')->toArray();
            $attribute_id = array_unique($attribute_id);
            
            // lất tất cả thuộc tính yêu cầu nhập khi mua hàng
            $attribute = Item::where('module','=','product-attribute')
            ->whereIn('id',$attribute_id)
            ->where('type',1)
            ->where('status',1)
            ->get();
            $options = [];
            // trường hợp sản phẩm có yêu cầu thuộc tính bắt buộc khi mua hàng
            if(isset($attribute) && count($attribute) > 0){
                $options = $request->options;
                foreach($attribute as $key => $item){
                    if(empty($options[$item->id])){
                        return response()->json([
                            'status' => 0,
                            'message' => "Vui lòng nhập đầy đủ thông tin yêu cầu.",
                        ]);
                    }
                }
            }
            // tao row_id sản phẩm trong giỏ hàng
            $row_id=md5($id.json_encode($options));

            if (Cookie::has('shopping_cart')){
                $cart = json_decode(Cookie::get('shopping_cart'),true);
                $found = in_array($row_id, array_column($cart, 'row_id'));
                if ($found) {
                    $key = array_search($row_id, array_column($cart, 'row_id'));
                    $cart[$key]["qty"]+=$qty;
                    Cookie::queue(Cookie::make('shopping_cart', json_encode($cart), 21600));
                    $arr = collect($cart);
                    foreach($arr as $item){
                        $total_cart[] = $item['qty'];
                    }
                    $total_cart = array_sum($total_cart);
                    return response()->json([
                        'status' => 1,
                        'total_cart' => $total_cart,
                        'message' => "Đã thêm sản phẩm vào giỏ hàng.",
                    ]);
                }
            }
            $cart[] = [
                'row_id'=>$row_id,
                'id' => $id,
                'title' => $data->title,
                'slug' => $data->slug,
                'qty' => $qty,
                'price' => $data->price,
                'price_base'=>$data->price_old,
                'image' => $data->image,
                'options'=>$options
            ];
            Cookie::queue(Cookie::make('shopping_cart',json_encode($cart), 21600));
            $arr = collect($cart);
            foreach($arr as $item){
                $total_cart[] = $item['qty'];
            }
            $total_cart = array_sum($total_cart);
            return response()->json([
                'status' => 1,
                'total_cart' => $total_cart,
                'message' => "Đã thêm sản phẩm vào giỏ hàng.",
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
    public function updateCart(Request $request, $rowId){
        try{
            if (Cookie::has('shopping_cart')){
                $delete = false;
                $redirect = false;
                $cart = json_decode(Cookie::get('shopping_cart'),true);
                $found = in_array($rowId, array_column($cart, 'row_id'));
                if($found){
                    $key = array_search($rowId, array_column($cart, 'row_id'));
                    // trường hợp trừ 1 sản phẩm
                    if($request->type == "minutes"){
                        $cart[$key]["qty"] = $cart[$key]["qty"] - 1;
                        $qtyItemCart = $cart[$key]["qty"];
                        if($qtyItemCart < 1){
                            unset($cart[$key]);
                            $delete = true;
                        }
                    }
                    // trường hợp cộng 1 sp
                    elseif($request->type == "plus"){
                        $cart[$key]["qty"] = $cart[$key]["qty"] + 1;
                        $qtyItemCart = $cart[$key]["qty"];
                    }
                    else{
                        return response()->json([
                            'status' => 0,
                            'message' => "Loại dữ liệu không hợp lệ, vui lòng kiểm tra lại.",
                        ]); 
                    }


                    $cart = array_values($cart);
                    Cookie::queue(Cookie::make('shopping_cart',json_encode($cart), 21600));
                    $arr = collect($cart);
                    if(isset($arr) && count($arr) > 0){
                        foreach($arr as $item){
                            $total[] = $item["price"] * $item['qty'];
                            $total_base[] = $item["price_base"] * $item['qty'];
                            $count[] = $item['qty'];
                        }
                        $total = array_sum($total);
                        $total_content = ucfirst(Helpers::StringMoney($total));
                        $total_base = array_sum($total_base);
                        $count = array_sum($count);
                        if($count < 1){
                            $redirect = true;
                        }
                        return response()->json([
                            'status' => 1,
                            'total' => number_format($total),
                            'total_content' => $total_content,
                            'total_base' => number_format($total_base - $total),
                            'qtyItemCart' => $qtyItemCart,
                            'count' => $count,
                            'delete' => $delete,
                            'redirect' => $redirect,
                            'message' => "Cập nhật giỏ hàng thành công.",
                        ]);
                    }
                    else{
                        $redirect = true;
                        return response()->json([
                            'status' => 1,
                            'redirect' => $redirect,
                            'message' => "Cập nhật giỏ hàng thành công.",
                        ]);
                    }
                }
                else{
                    return response()->json([
                        'status' => 0,
                        'message' => "Không tìm thấy sản phẩm trong giỏ hàng.",
                    ]);
                }
            }
            else{
                return response()->json([
                    'status' => 0,
                    'message' => "Giỏ hàng trống.",
                ]);
            }
        }
        catch(\Exception $e){
            Log::error($e);
            return response()->json([
                'status' => 0,
                'message' => "Có lỗi phát sinh, vui lòng thử lại.",
            ]);
        }
    }
    public function deleteCart(Request $request, $rowId){
        try{
            if (Cookie::has('shopping_cart')){
                $delete = false;
                $redirect = false;
                $cart = json_decode(Cookie::get('shopping_cart'),true);
                $found = in_array($rowId, array_column($cart, 'row_id'));
                if($found){
                    $key = array_search($rowId, array_column($cart, 'row_id'));
                    unset($cart[$key]);
                    $delete = true;
                    $cart = array_values($cart);
                    Cookie::queue(Cookie::make('shopping_cart',json_encode($cart), 21600));
                    $arr = collect($cart);
                    if(isset($arr) && count($arr) > 0){
                        foreach($arr as $item){
                            $total[] = $item["price"] * $item['qty'];
                            $total_base[] = $item["price_base"] * $item['qty'];
                            $count[] = $item['qty'];
                        }
                        $total = array_sum($total);
                        $total_content = ucfirst(Helpers::StringMoney($total));
                        $total_base = array_sum($total_base);
                        $count = array_sum($count);
                        if($count < 1){
                            $redirect = true;
                        }
                        return response()->json([
                            'status' => 1,
                            'total' => number_format($total),
                            'total_content' => $total_content,
                            'total_base' => number_format($total_base - $total),
                            'count' => $count,
                            'delete' => $delete,
                            'redirect' => $redirect,
                            'message' => "Cập nhật giỏ hàng thành công.",
                        ]);
                    }
                    else{
                        $redirect = true;
                        return response()->json([
                            'status' => 1,
                            'redirect' => $redirect,
                            'message' => "Cập nhật giỏ hàng thành công.",
                        ]);
                    }
                }
                else{
                    return response()->json([
                        'status' => 0,
                        'message' => "Không tìm thấy sản phẩm trong giỏ hàng.",
                    ]);
                }
            }
            else{
                return response()->json([
                    'status' => 0,
                    'message' => "Giỏ hàng trống.",
                ]);
            }
        }
        catch(\Exception $e){
            Log::error($e);
            return response()->json([
                'status' => 0,
                'message' => "Có lỗi phát sinh, vui lòng thử lại.",
            ]);
        }
    }

    public function getDistricts(Request $request){
        try{
            $code = $request->code;
            $districts = Districts::where('province_code',$code)->select('id','code','name','province_code')->get();
            return response()->json([
                'status' => 1,
                'message' => "Thành công",
                'data' => $districts
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
}
