<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Telegram\Bot\Laravel\Facades\Telegram;
use DateTime;
use App\Library\TECHCOMBANK;
use App\Library\Helpers;
use Carbon\Carbon;
use Auth;
use App\Models\Bank;


class TestController extends Controller
{



    public function __construct()
    {

    }

    public function index(){
        // $dataBank = Bank::where("key","TECHCOMBANK")->where('status',1)->get();
        // if(isset($dataBank) && count($dataBank) > 0){
        //     foreach($dataBank as $item){
        //         $bank = new \stdClass();
        //         $bank->id = $item->id;
        //         $bank->username = $item->username;
        //         $bank->password = Helpers::Decrypt($item->password,config('module.bank.key_hash_password'));
        //         TECHCOMBANK::HandleData(false,$bank);
        //         continue;
        //     }
        // }
        // return 111;
        // $content = "OK";
        // Helpers::TelegramNotify($content,config('telegram.bots.mybot.channel_id_hook'));
        // $activity = Telegram::getUpdates();
        // dd($activity);


        // $username = "0388119141";
        // $password = "Truong00";
        // $user = Auth::user();
        // $bank = new \stdClass();
        // $bank->id = 1;
        // $bank->username = $username;
        // $bank->password = $password;
        // $data = TECHCOMBANK::HandleData($user,$bank);
        // return $data;
    }

    public function indexBACKUP(){
        $username = "0388119141";
        $password = "Truong00";

        $data = TECHCOMBANK::getTransactions($username,$password);
        dd($data);

        $curl = curl_init();
        $data = array();
        $data["username"] = $username;
        $data["password"] = $password;
        $dataPost = json_encode($data); 
        $header = [
            'Accept: application/json',
            'Accept-Encoding: gzip, deflate',
            'User-Agent: Mozilla/5.0 (Linux; Android 5.1.1; SM-N971N Build/LYZ28N; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/52.0.2743.100 Mobile Safari/537.36',
            'X-Requested-With: com.fastacash.tcb',
            'Content-Type: application/json',
        ];
 
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://mob.techcombank.com.vn/mobiliser/rest/smartphone/getBalance',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>$dataPost,
          CURLOPT_HTTPHEADER => $header,
        ));
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
         
        $response = curl_exec($curl);
         
        curl_close($curl);
        dd($response,$httpcode);
    }

    public function indexBK(){
        $time = round(microtime(true) * 1000);
        $url = "https://mob.techcombank.com.vn/mobiliser/rest/smartphone/loginTcbCustomer";
        // $username = "0977035001";
        // $password = "Ongchiu3";
        $username = "0388119141";
        $password = "Truong00";
        $data = array();
        $data["origin"] = "MAPP";
        $data["traceNo"] = time().rand(10000,99999);
        $AuditData = array();
        $AuditData['device'] = "Android/5.1.1 SM-N971N";
        $AuditData['deviceId'] = "26f52d8f1bd5436a";
        $AuditData['otherDeviceId'] = "8.1.0";
        $AuditData['application'] = "MAPP";
        $AuditData['applicationVersion'] = "1.2.2.8";
        $data['AuditData'] = $AuditData;
        $data['identification'] = $username;
        $data['credential'] = $password;
        $data['identificationType'] = "0";
        $data['credentialType'] = "0";
        $UnstructuredData = array();
        $UnstructuredData1 = array();
        $UnstructuredData1['Key'] = "DeviceToken";
        $UnstructuredData1['Value'] = "[adr]fqWuVWLASvS91RpA8K-dgp:APA91bH_FlcAMKC196xVr8txuRWpohXKc1Eo63foPkO6ba_IDk3YY4H6dzi7l2FVco5JDKjXGsNEmseON7d6nDC6UcEHX7HLOD-Tifm6HqeKYcokAaDCWq_6m2rffTrMNlzVPgMWJxmM";
        $UnstructuredData2 = array();
        $UnstructuredData2['Key'] = "DeviceTime"; 
        $UnstructuredData2['Value'] = $time;
        $UnstructuredData = [$UnstructuredData1,$UnstructuredData2];
        $data['UnstructuredData'] = $UnstructuredData;
        $dataPost = json_encode($data); 
        $header = [
            'Accept: application/json',
            'Accept-Encoding: gzip, deflate',
            'User-Agent: Mozilla/5.0 (Linux; Android 5.1.1; SM-N971N Build/LYZ28N; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/52.0.2743.100 Mobile Safari/537.36',
            'X-Requested-With: com.fastacash.tcb',
            'Content-Type: application/json',
        ];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://mob.techcombank.com.vn/mobiliser/rest/smartphone/loginTcbCustomer',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>$dataPost,
            CURLOPT_HTTPHEADER => $header,
        ));
        curl_setopt($curl, CURLOPT_HEADER, 1);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $response = curl_exec($curl);
        curl_close($curl);
        $lines = explode("\n", $response);
        $headers = array();
        $result = "";
        foreach($lines as $num => $line){
            $l = str_replace("\r", "", $line);
            if(trim($l) == ""){
                $headers = array_slice($lines, 0, $num);
                $result = $lines[$num + 1];
                $cookies = preg_grep('/^Set-Cookie:/', $headers);
                break;
            }
        }
        $result = json_decode($result);
        // dd($response,$headers,$result);
        if($result && isset($result->Status) && isset($result->Status->code) && $result->Status->code == 0){
            $customer = $result->customer;
            $customerId = $customer->id;
            $cookies = array_merge($cookies);
            $data_cookies = "";
            foreach($cookies as $item){
                $string = str_replace('Set-Cookie:','',$item);
                $string = str_replace(' ','',$string);
                $string = explode(";",$string);
                $data_cookies .= $string[0]."; ";
            }
            // $paymentInstrumentId = $this->getPaymentInstrumentId($customerId,$data_cookies);
            $this->getPayment($customer,$data_cookies);
        }
    }
    public function getPaymentInstrumentId($customerId,$data_cookies){
        $url = "https://mob.techcombank.com.vn/mobiliser/rest/smartphone/getWalletEntriesByCustomer";
        $data = array();
        $data["origin"] = "MAPP";
        $data["traceNo"] = time().rand(10000,99999);
        $AuditData = array();
        $AuditData['device'] = "Android/5.1.1 SM-N971N";
        $AuditData['deviceId'] = "26f52d8f1bd5436a";
        $AuditData['otherDeviceId'] = "8.1.0";
        $AuditData['application'] = "MAPP";
        $AuditData['applicationVersion'] = "1.2.2.8";
        $data['AuditData'] = $AuditData;
        $data['customerId'] = $customerId;
        $dataPost = json_encode($data);
        $header = [
            'Connection: keep-alive',
            'Accept: application/json',
            'User-Agent: Mozilla/5.0 (Linux; Android 5.1.1; SM-N971N Build/LYZ28N; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/52.0.2743.100 Mobile Safari/537.36',
            'Content-Type: application/json',
            'Accept-Encoding: gzip, deflate',
            'Accept-Language: en-US',
            'Cookie: '.$data_cookies,
            'X-Requested-With: com.fastacash.tcb',
        ];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>$dataPost,
            CURLOPT_HTTPHEADER => $header,
        ));
        $response = curl_exec($curl);
        dd($response);
    }

    function getPayment($customer,$data_cookies){
        $url = "https://mob.techcombank.com.vn/mobiliser/rest/smartphone/findTcbTransactions";
        $time = round(microtime(true) * 1000);
        $data = array();
        $data["origin"] = "MAPP";
        $data["traceNo"] = time().rand(10000,99999);
        $AuditData = array();
        $AuditData['device'] = "Android/5.1.1 SM-N971N";
        $AuditData['deviceId'] = "26f52d8f1bd5436a";
        $AuditData['otherDeviceId'] = "8.1.0";
        $AuditData['application'] = "MAPP";
        $AuditData['applicationVersion'] = "1.2.2.8";
        $data['AuditData'] = $AuditData;
        $data['maxRecords'] = "10000";
        $data['fromDate'] = "20211028";
        $data['toDate'] = "20211228";
        $data['paymentInstrumentId'] = "23580490119";
        $dataPost = json_encode($data); 
      
        $header = [
            'Connection: keep-alive',
            'Accept: application/json',
            'User-Agent: Mozilla/5.0 (Linux; Android 5.1.1; SM-N971N Build/LYZ28N; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/52.0.2743.100 Mobile Safari/537.36',
            'Content-Type: application/json',
            'Accept-Encoding: gzip, deflate',
            'Accept-Language: en-US',
            'Cookie: '.$data_cookies,
            'X-Requested-With: com.fastacash.tcb',
        ];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>$dataPost,
            CURLOPT_HTTPHEADER => $header,
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $result = json_decode($response);
        dd($result,$httpcode);
    }
}
