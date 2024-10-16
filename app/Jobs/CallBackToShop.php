<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use App\Models\User;
use App\Library\HelpersApi;
use App\Library\Helpers;
use DB;
use Log;

class CallBackToShop implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
            // xử lý ở đây
            $shop_id =$this->data['shop_id'];
            $order_id = $this->data['order_id'];
            $order = Order::where('module','hook')->where('gate_id',2)->where('id',$order_id)->first();
            if(!$order){
                return false;
            }
            $shop = User::where('account_type',2)->where('id',$shop_id)->where('is_agency_charge',1)->where('status',1)->lockForUpdate()->first();
            if(!$shop){
                return false;
            }
            $urlCallback = $shop->url_callback; // url callback
            if(!$urlCallback){
                $content = "Không tìm thấy URL CALLBACK của shop ".$shop->username;
                Helpers::TelegramNotify($content,config('telegram.channel_id_hook'));
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
            Log::error($e);
            return false;
        }
    }
}
