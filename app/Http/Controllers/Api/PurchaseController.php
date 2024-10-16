<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class PurchaseController extends Controller
{
    public function postGetOrderId(Request $request){

    }
    public function postMessageTelegram(Request $request){
        $sign = md5('hqplay');
        if($request->sign != $sign){
            return "sign khong hop le";
        }
        $channel_id = $request->channel_id;
        $content = $request->content;
        Telegram::sendMessage([
            'chat_id' => $channel_id,
            'parse_mode' => 'HTML',
            'text' => $content
        ]);
        return "OK";
    }
}
