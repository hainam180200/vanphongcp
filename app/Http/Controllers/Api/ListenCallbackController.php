<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cache;
use DB;
use Log;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\User;
use App\Library\Helpers;
use App\Library\HelpersApi;
use App\Library\HelpersHubBank;

class ListenCallbackController extends Controller
{
    public function VeryToken($token){
        $list = config('hook.token.0');
        $list = explode(",", $list);
        if(in_array($token,$list)){
            return true;
        }
        return false;
    }
    public function getHeader($header) {
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                Log::error($_SERVER);
                if (str_replace(' ', '-', ucwords(str_replace('_', ' ', substr($name, 5)))) == $header)
                    return $value;
            }
        }
        return false;
    }
    public function getHookCallback(Request $request){
        if (strtolower($request->site) == strtolower("thueapi")) {
            return $this->ThueApiCallback($request);
        }
    }
    public function ThueApiCallback(Request $request){
        $myfile = fopen(storage_path() . "/logs/thueApi-callback-".Carbon::now()->format('Y-m-d').".txt", "a") or die("Unable to open file!");
        $txt = Carbon::now().":".$request->fullUrl().json_encode($request->all());
        fwrite($myfile, $txt . "\n");
        fclose($myfile);
        // trường hợp api nhận tiền
        if($request->type == "in"){
            return $this->ThueApiTypeIn($request);
        }
    }
    public function ThueApiTypeIn(Request $request){
        $myfile = fopen(storage_path() . "/logs/thueApi-InMoney-".Carbon::now()->format('Y-m-d').".txt", "a") or die("Unable to open file!");
        $txt = Carbon::now().":".$request->fullUrl().json_encode($request->all());
        fwrite($myfile, $txt . "\n");
        fclose($myfile);
        if($request->txn_id == null){
            return "Tnx_id không hợp lệ";
        }
        $thueapiToken = $request->header('X-Thueapi');
        $very_token = $this->VeryToken($thueapiToken);
        if($very_token == false){
            return "Token không hợp lệ";
        }
        DB::beginTransaction();
        try{
            $txn_id = $request->txn_id;
            $checkOrder = Order::where('module','hook')->where('gate_id',1)->where('tranid',$txn_id)->first();
            if($checkOrder){
                DB::rollback();
                return "Tnx_id đã tồn tại";
            } 
            $dataOrder = $request->content;
            $params = new \stdClass();
            $params->phone = $request->phone;
            $params->name = $request->name;
            $params->content = $request->content;
            $params->gateway = $request->gateway;
            $params->type = $request->type;
            $params->datetime = $request->datetime;
            $params = json_encode($params,JSON_UNESCAPED_UNICODE);
            $order = Order::create([
                'module' => 'hook',
                'payment_type' => 1,
                'tranid' => $request->txn_id,
                'gate_id' => 1,
                'title' => $request->gateway,
                'params' => $params,
                'price' => $request->money,
                'description' => $request->content,
            ]);
            $dataShopApi = HelpersHubBank::ConvertOrderAndShop($dataOrder);
            if($dataShopApi == false){
                $content = "Cảnh báo: nội dung trả về từ Thueapi có lỗi trong quá trình xử lý thông tin nội dung đơn hàng, vui lòng kiểm tra.";
                $order->content = $content;
                $order->save();
                DB::commit();
                Helpers::TelegramNotify($content,config('telegram.bots.mybot.channel_id_hook'));
                return $content;
            }
            if($dataShopApi == "-1"){
                $content = "Cảnh báo: nội dung trả về từ Thueapi không xử lý được thông tin shop callback, vui lòng kiểm tra.";
                $order->content = $content;
                $order->save();
                DB::commit();
                Helpers::TelegramNotify($content,config('telegram.bots.mybot.channel_id_hook'));
                return $content;
            }
            if($dataShopApi == "-2"){
                $content = "Cảnh báo: nội dung trả về từ Thueapi không đúng cú pháp nạp, vui lòng kiểm tra.";
                $order->content = $content;
                $order->save();
                DB::commit();
                Helpers::TelegramNotify($content,config('telegram.bots.mybot.channel_id_hook'));
                return $content;
            }
            if($dataShopApi == "999"){
                $content = "Cảnh báo: nội dung trả về từ Thueapi không xử lý được thông tin đơn hàng, vui lòng kiểm tra.";
                $order->content = $content;
                $order->save();
                DB::commit();
                Helpers::TelegramNotify($content,config('telegram.bots.mybot.channel_id_hook'));
                return $content;
            }
            // trường hợp convert nội dung thành công
            $shop_key = $dataShopApi->shop_key;
            $order_shop_id = $dataShopApi->order_id;
            // tìm shop callback
            $shop = User::where('account_type',2)->where('agency_code',$shop_key)->where('is_agency_charge',1)->where('status',1)->lockForUpdate()->first();
            if(!$shop){
                $content = "Cảnh báo: đơn hàng #".$order->id. " không tìm thấy shop callback, vui lòng kiểm tra !";
                $order->content = $content;
                $order->save();
                DB::commit();
                Helpers::TelegramNotify($content,config('telegram.bots.mybot.channel_id_hook'));
                return $content;
            }

            // cộng tiền cho shop 
            $shop->balance = $shop->balance + $order->price;
            $shop->balance_in = $shop->balance_in + $order->price;

            $shop->save();

            $order->author_id = $shop->id;
            $order->order = $order_shop_id;
            $order->save();
            DB::commit();
            // khởi tạo data trả về shop
            $urlCallback = $shop->url_callback; // url callback
            if(!$urlCallback){
                $content = "Không tìm thấy URL CALLBACK của shop ".$shop->username;
                Helpers::TelegramNotify($content,config('telegram.bots.mybot.channel_id_hook'));
                return $content;
            }
            $arrayApi = array();
            $arrayApi['order_id'] = $order->order; // mã đơn hàng trên shop
            $arrayApi['gateway'] = $order->title; // ngan hang chuyen tien
            $arrayApi['status'] = 1; // trạng thái đơn hàng thành công
            $arrayApi['shop_key'] = $shop->agency_code; // mã shop đc cấu hình trên website
            $arrayApi['shop_name'] = $shop->username; // ten shop đc cấu hình trên website
            $arrayApi['amount'] = $order->price; // số tiền api trả về
            $arrayApi['content'] = $order->description; // nội dung thanh toán
            $arrayApi['tranid'] = $order->id; //id mã giao dịch của hook
            $callback = HelpersApi::CallbackApi($arrayApi,$urlCallback,$shop->id);
            $order->content = $callback;
            $order->save();
            return "# Xử lý giao dịch thành công.";
        }
        catch(\Exception $e){
            DB::rollback();
            Log::error($e);
            return "Có lỗi phát sinh, vui lòng thử lại.";
        }
    }
}
