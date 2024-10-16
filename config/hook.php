<?php
    return [
        'shop' => [
            "A" => [
                'name' => 'PASSIONZONE',
                'callback' => 'https://frontend.passionzone.net/api/callback/hook'
            ],
        ],
        'gate_id' => [
            "1" => 'ThueApi.com',
            "2" => "Hệ thống tự lấy dữ liệu"
        ],
        'type' => [
            "1" => 'Nhận tiền'
        ],
        'key_sign' => 'mzd5sam7aU9glCwZDdd7',
        'token' => [
           env('TOKEN_THUEAPI'),
        ],
        'payment_type' => [
            "0" => "Chuyển tiền",
            "1" => "Nhận tiền",
        ],
    ];
?>