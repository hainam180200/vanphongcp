<?php
namespace App\Library;
use Telegram\Bot\Laravel\Facades\Telegram;
use DateTime;
use Carbon\Carbon;

use Html;

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/18/2016
 * Time: 3:14 PM
 */
class Helpers
{
    public static function Encrypt($string,$secret_key="") {
        $output = "";

        $encrypt_method = "AES-256-CBC";
        if($secret_key==null ||$secret_key==""){
            $secret_key = 'keymahoa';
        }
        $secret_iv = 'hash';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }

    public static function Decrypt($string,$secret_key="") {
        $output = "";

        $encrypt_method = "AES-256-CBC";
        if($secret_key==null ||$secret_key==""){
            $secret_key = 'keymahoa';
        }
        $secret_iv = 'hash';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        if($output==false){
            return "";
        }
        return $output;
    }









    //active link function
    public static function SetActiveLink($path, $active = 'active')
    {

        return call_user_func_array('Request::is', (array)$path) ? $active : '';
//        		if(is_array($route))
//        		{
//        			return in_array(Request::path(), $route) ? 'active' : '';
//        		}
//        		return Request::path() == $route ? 'active' : '';
    }




    public static function rand_string($length)
    {
        $str = '';
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

        $size = strlen($chars);
        for ($i = 0; $i < $length; $i++) {

            $str .= $chars[rand(0, $size - 1)];
        }

        return $str;
    }

    public static function rand_num_string($length)
    {
        $str = '';
        $chars = "0123456789";

        $size = strlen($chars);
        for ($i = 0; $i < $length; $i++) {

            $str .= $chars[rand(0, $size - 1)];
        }

        return $str;
    }



    public static function FormatDateTime($format, $value)
    {
        //'d/m/Y'
        //'d/m/Y H:i:s'

        $result = date($format, strtotime($value));
        if ($result != "01/01/1970") {
            return $result;
        } else {
            return "";
        }
    }


    public static function ConvertToAgoTime($time)
    {
        $time = strtotime($time);

        $time = time() - $time; // to get the time since that moment

        if ($time == 0) {
            return "Vừa xong";
        }
        $tokens = array(
            31536000 => 'năm',
            2592000 => 'tháng',
            604800 => 'tuần trước',
            86400 => 'ngày trước',
            3600 => 'giờ trước',
            60 => 'phút trước',
            1 => 'giây trước',

        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? '' : '');
        }

    }


    public static function LimitString($text, $limit)
    {

        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }

    public static function getNWords($string, $n = 5, $withDots = true)
    {
        $excerpt = explode(' ', strip_tags($string), $n + 1);
        $wordCount = count($excerpt);
        if ($wordCount >= $n) {
            array_pop($excerpt);
        }
        $excerpt = implode(' ', $excerpt);
        if ($withDots && $wordCount >= $n) {
            $excerpt .= '...';
        }
        return $excerpt;
    }



    //build for dropdownlist
    public static function buildMenuDropdownList($dataCategory, $selected, $idparent = 0, $stringSpecial = "")
    {

        $result = null;


        foreach ($dataCategory as $item) {

            if ($item->parent_id == $idparent) {

                $checked = "";
                foreach ((array)$selected as $key => $value) {
                    if ($value == $item->id) {
                        $checked = "selected";
                        break;
                    }
                }
                $result .= "<option value='" . $item->id . "'" . $checked . ">" . Html::entities($stringSpecial . ' ' . $item->title) . "</option>";

                $result .= self::buildMenuDropdownList($dataCategory, $selected, $item->id, $stringSpecial . "¦– – ");
            }
        }
        return $result;
    }

    public static function GetChildrenCategory($menu, $parent_id)
    {

        $result = null;
        foreach ($menu as $item)
            if ($item->parent_id == $parent_id) {
                $result .= ',' . $item->id;
                $result .= self::GetChildrenCategory($menu, $item->id);

            }
        return $result ? "$result" : null;
    }

    public static function TelegramNotify($content,$channel_id = ""){
        try{
            if($channel_id == "" || $channel_id == null){
                $channel_id = config('telegram.bots.mybot.channel_id');
            }
            Telegram::sendMessage([
                'chat_id' => $channel_id,
                'parse_mode' => 'HTML',
                'text' => $content
            ]);
        }
        catch (\Exception $e) {
            return false;
        }
    }

    public static function getSearch($request,$nameSearch,$params){
        $url = parse_url($request);
        $query_str = parse_url($request, PHP_URL_QUERY);
        parse_str($query_str, $query_params);
        if(isset($query_params[$nameSearch])){
            $query_params[$nameSearch] = $params;
        }
        else{
            $query_params[$nameSearch] = $params;
        }
        $query = http_build_query($query_params);
        $result = $url['scheme'].'://'.$url['host'].$url['path'].'?'.$query;
        return $result;
    }   
    public static function StringMoney($number) {
        try{
           $hyphen      = ' ';
            $conjunction = '  ';
            $separator   = ' ';
            $negative    = 'âm ';
            $decimal     = ' phẩy ';
            $dictionary  = array(
            0                   => 'không',
            1                   => 'một',
            2                   => 'hai',
            3                   => 'ba',
            4                   => 'bốn',
            5                   => 'năm',
            6                   => 'sáu',
            7                   => 'bảy',
            8                   => 'tám',
            9                   => 'chín',
            10                  => 'mười',
            11                  => 'mười một',
            12                  => 'mười hai',
            13                  => 'mười ba',
            14                  => 'mười bốn',
            15                  => 'mười năm',
            16                  => 'mười sáu',
            17                  => 'mười bảy',
            18                  => 'mười tám',
            19                  => 'mười chín',
            20                  => 'hai mươi',
            30                  => 'ba mươi',
            40                  => 'bốn mươi',
            50                  => 'năm mươi',
            60                  => 'sáu mươi',
            70                  => 'bảy mươi',
            80                  => 'tám mươi',
            90                  => 'chín mươi',
            100                 => 'trăm',
            1000                => 'nghìn',
            1000000             => 'triệu',
            1000000000          => 'tỷ',
            1000000000000       => 'nghìn tỷ',
            1000000000000000    => 'nghìn triệu triệu',
            1000000000000000000 => 'tỷ tỷ'
            );
        if (!is_numeric($number)) {
            return false;
        }
        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
            );
            return false;
        }
        if ($number < 0) {
            return $negative . self::StringMoney(abs($number));
        }
        $string = $fraction = null;
            if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }
        switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
        break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
        break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . self::StringMoney($remainder);
            }
        break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = self::StringMoney($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= self::StringMoney($remainder);
            }
            break;
        }
        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }
        return $string;
    }
    catch (\Exception $e) {
        return 'Lỗi hiển thị';
    }	
	}

    public static function NumberFormatShort( $n, $precision = 1){
        if ($n < 900) {
            // 0 - 900
            $n_format = number_format($n, $precision);
            $suffix = '';
        } else if ($n < 900000) {
            // 0.9k-850k
            $n_format = number_format($n / 1000, $precision);
            $suffix = 'K';
        } else if ($n < 900000000) {
            // 0.9m-850m
            $n_format = number_format($n / 1000000, $precision);
            $suffix = 'M';
        } else if ($n < 900000000000) {
            // 0.9b-850b
            $n_format = number_format($n / 1000000000, $precision);
            $suffix = 'B';
        } else {
            // 0.9t+
            $n_format = number_format($n / 1000000000000, $precision);
            $suffix = 'T';
        }
        if ( $precision > 0 ) {
            $dotzero = '.' . str_repeat( '0', $precision );
            $n_format = str_replace( $dotzero, '', $n_format );
        }
    
        return $n_format . $suffix;
    }

    public static function FormatDateTimeToF($date){
        $date = Carbon::createFromFormat('d/m/YY', $date)->format('d-m-Y');
        return date('F d, Y H:i:s', strtotime($date));
    }
}
