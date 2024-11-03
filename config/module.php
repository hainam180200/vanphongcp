<?php


return [

    'media' => [
        'url' => env('MEDIA_URL'),
    ],

    'user-qtv' => [
        'need_set_permission'=>true,
        'status' => [
            '1' => 'Hoạt động',
            '2' => 'Chờ kích hoạt',
            '0' => 'Khóa'
        ],
        'account_type' => [
            '1' => 'Quản trị viên (Nội bộ)',
            '2' => 'Thành viên'
        ]
    ],

    'user' => [
        'status' => [
            '1' => 'Hoạt động',
            '2' => 'Chờ kích hoạt',
            '0' => 'Khóa'
        ],
        'account_type' => [
            '1' => 'Quản trị viên (Nội bộ)',
            '2' => 'Thành viên'
        ],

        'is_idol' => [
            '0' => 'Không',
            '1' => 'Có'
        ],
        'is_agency_charge' => [
            '0' => 'Không',
            '1' => 'Có'
        ],
        'type_idol' => [
            '1' => 'Idol',
            '2' => 'Đang chờ phê duyệt'
        ],
        'effect_profile' => [
            '0' => 'Hiệu ứng tuyết rơi',
            '1' => 'Hiệu ứng trái tim rơi',
            '2' => 'Hiệu ứng mưa'
        ],
        'image_fake' =>[
            '0' => 'https://media.passionzone.net/storage/upload/images/default-placeholder%20111(9).png',
            '1' => 'https://media.passionzone.net/storage/upload/images/logo%20pubg%20mobile.png',
            '2' => 'https://media.passionzone.net/storage/upload/images/toc-chien.jpg',
            '3' => 'https://media.passionzone.net/storage/upload/images/playtogether.jpg',
        ],

        'payment_limit'=>1000000,
        'limit_fail_charge'=>5
    ],

    'user-action' => [
        'action' => [
            'vote' => 'Vote',
            'comment' => 'Comment',
            'block' => 'Block'
        ],
    ],

    'language-nation' => [
        'status' => [
            '1' => 'Hoạt động',
            '0' => 'Ngừng hoạt động',
        ],

        'is_default' => [
            '0' => 'Không',
            '1' => 'Mặc định',
        ],
    ],

    'language-key' => [
        'status' => [
            '1' => 'Hoạt động',
            '0' => 'Ngừng hoạt động',

        ],
    ],

    'menu-category' => [
        'title'=>"Menu trang chủ",
        '__include'=>[],
        'status' => [
            '1' => 'Hoạt động',
            '0' => 'Ngừng hoạt động',

        ],
    ],


    //-------------------- game --------------------//
    'game-category' => [
        'title'=>"Danh mục game",
        'status' => [
            '1' => 'Hoạt động',
            '0' => 'Ngừng hoạt động',

        ],
    ],

    //-------------------- product --------------------//
    'product-category' => [
        'title'=>"Danh mục văn bản",
        'status' => [
            '1' => 'Hoạt động',
            '0' => 'Ngừng hoạt động',

        ],
    ],
    'product-group' => [
        'title'=>"Loại văn bản",
        'status' => [
            '1' => 'Hoạt động',
            '0' => 'Ngừng hoạt động',

        ],
    ],
    'product-field' => [
        'title'=>"Lĩnh vực",
        'status' => [
            '1' => 'Hoạt động',
            '0' => 'Ngừng hoạt động',

        ],
    ],
    'product-agency' => [
        'title'=>"Cơ quan ban hành",
        'status' => [
            '1' => 'Hoạt động',
            '0' => 'Ngừng hoạt động',

        ],
    ],
    'product' => [
        'title'=>"Tất cả văn bản",
        'status' => [
            '1' => 'Hoạt động',
            '0' => 'Ngừng hoạt động',

        ],
        'installment' => [
            '0' => 'Không',
            '1' => 'Có'
        ],
        'is_point' => [
            '0' => 'Không',
            '1' => 'Có'
        ],
        'sort' => [
            '1' => 'Sản phẩm mới - cũ',
            '2' => 'Giá thấp - cao',
            '3' => 'Giá cao - thấp',
            '4' => 'Mới cập nhật',
            '5' => 'Xem nhiều hôm nay',
            '6' => 'Xem nhiều tuần này',
            '7' => 'Xem nhiều tháng này',
            '8' => 'Xem nhiều nhất'
        ]
    ],
    'product-attribute' => [
        'title'=>"Tất cả thuộc tính",
        'status' => [
            '1' => 'Hoạt động',
            '0' => 'Ngừng hoạt động',

        ],
        'type' => [
            '1' => 'Thông số mua hàng',
            '2' => 'Thông số kĩ thuật',
            '3' => 'Cả 2 loại trên'
        ],
    ],
    'comment' => [
        'title'=>"Quản lý bình luận",
    ],
    'order' => [
        'title'=>"Quản lý đơn hàng",
    ],
    'installment' => [
        'title'=>"Quản lý trả góp",
        'status' => [
            '1' => 'Hoạt động',
            '0' => 'Ngừng hoạt động',
        ],
        'type' => [
            '1' => 'Công ty tín dụng'
        ]
    ],
    'installment-report' => [
        'title'=>"Đơn hàng trả góp",
        'status' => [
            '1' => 'Đã xử lý',
            '2' => 'Đang chờ xử lý',
        ],
    ],


    //-------------------- article --------------------//
    'article-category' => [
        'key'=>"article-category",
        'title'=>"Danh mục bài viết",
        'status' => [
            '1' => 'Hoạt động',
            '0' => 'Ngừng hoạt động',

        ],
    ],

    'article-group' => [
        'key'=>"article-group",
        'title'=>"Nhóm bài viết",
        'status' => [
            '1' => 'Hoạt động',
            '0' => 'Ngừng hoạt động',

        ],
    ],
    'article' => [
        'key'=>"article",
        'title'=>"Tất cả bài viết",
        'status' => [
            '1' => 'Hoạt động',
            '0' => 'Ngừng hoạt động',
        ],


    ],



    //-------------------- sticky --------------------//

    'sticky' => [
        'title'=>"Tất cả sticky",
        'status' => [
            '1' => 'Hoạt động',
            '0' => 'Ngừng hoạt động',

        ],
        'params_field'=>[
                [
                    'label' => 'Chiết khấu ăn chia (%)', // you know what label it is
                    'name' => 'params[ratio]', // unique name for field
                    'type' => 'number', // input fields type
                    'data' => '', // data type, string, int, boolean
                    'rules' => '', // validation rule of laravel
                    'div_parent_class' => 'col-6 col-md-6', // div parent class for input
                    'class' => '', // any class for input
                    'value' => 'demo', // default value if you want
                    'height' => '' // default height if you want ckfinder
                ],

        ],

    ],
    'audio' => [
        'title'=>"Tất cả audio",
        'status' => [
            '1' => 'Hoạt động',
            '0' => 'Ngừng hoạt động',

        ],
        'params_field'=>[
            [
                'label' => 'File âm thanh', // you know what label it is
                'name' => 'params[file]', // unique name for field
                'type' => 'file', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'div_parent_class' => 'col-6 col-md-6', // div parent class for input
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],

        ],

    ],
    'transfer-bank' => [
        'title'=>"Ngân hàng giao dịch",
        'key' => 'transfer-bank',
        'status' => [
            '1' => 'Hoạt động',
            '0' => 'Ngừng hoạt động',
        ],
    ],
    'transfer' => [
        'title'=>"Chuyển khoản thủ công",
        'key' => 'transfer',
        'status' => [
            '0' => 'Thất bại',
            '1' => 'Thành công (Số tiền đúng)',
            '2' => 'Đang chờ',
            '3' => 'Thành công (Số tiền sai)',
        ],
    ],

    //-------------------- page --------------------//

    'page' => [
        'title'=>"Trang nội dung",
        'status' => [
            '1' => 'Hoạt động',
            '0' => 'Ngừng hoạt động',

        ],
    ],


    //-------------------- adv --------------------//
    'advertise-category' => [
        'key'=>"advertise-category",
        'title'=>"Danh mục quảng cáo",
        'status' => [
            '1' => 'Hoạt động',
            '0' => 'Ngừng hoạt động',

        ],
    ],
    'advertise-group' => [
        'key'=>"advertise-group",
        'title'=>"Nhóm quảng cáo",
        'status' => [
            '1' => 'Hoạt động',
            '0' => 'Ngừng hoạt động',

        ],
    ],
    'advertise' => [
        'key'=>"advertise",
        'title'=>"Tất cả quảng cáo",
        'position' => [
            'SLIDES_ADS_1' => 'Slide đầu trang',
            'SLIDES_ADS_2' => 'Slide góc phải',
            'BANNER_RIGHT_ADS_1' => 'Banner góc phải 1',
            'BANNER_RIGHT_ADS_2' => 'Banner góc phải 2',
            'BANNER_LEFT_ADS_1' => 'Banner bên trái 1',
            'BANNER_LEFT_ADS_2' => 'Banner bên trái 2',
            'BANNER_LEFT_ADS_3' => 'Banner bên trái 3',
            'BANNER_LEFT_ADS_4' => 'Banner bên trái 4',
            'IFRAME_ADS_1' => 'Iframe góc phải 1',
            'IFRAME_ADS_2' => 'Iframe góc phải 2',
        ],
        'status' => [
            '1' => 'Hoạt động',
            '0' => 'Ngừng hoạt động',

        ],
    ],

    //-------------------- menutop --------------------//
    'menutop-category' => [
        'key'=>"menutop-category",
        'title'=>"Menu top",
        'status' => [
            '1' => 'Hoạt động',
            '0' => 'Ngừng hoạt động',

        ],
    ],
    //-------------------- menutop --------------------//
    'menublog-category' => [
        'key'=>"menublog-category",
        'title'=>"Menu blog",
        'status' => [
            '1' => 'Hoạt động',
            '0' => 'Ngừng hoạt động',

        ],
    ],
    //-------------------- menu chính--------------------//
    'menu-category' => [
        'key'=>"menu-category",
        'title'=>"Menu chính",
        'status' => [
            '1' => 'Hoạt động',
            '0' => 'Ngừng hoạt động',

        ],
    ],



    //-------------------- booking --------------------//

    'booking' => [
        'title' => 'Booking',
        'key' => 'booking',
        'status' => [
            '1' => 'Tất toán xong',
            '0' => 'Tất toán thất bại',
            '2' => 'Đang chờ thanh toán',
            '3' => 'Đã hủy',
            '4' => 'Đang chờ xử lý',
            '5' => 'Đã nhận đơn',
            '6' => 'Thành công',
            '-2' => 'Đã Hủy',
            '-1' => 'Hệ thống tự hủy',
        ],
        'url_trans' =>  env('URL_GG_SOUND'),
        'payment_type' => [
            '0' => 'Thanh toán bằng tài khoản',
            '1' => 'Thanh toán ngân hàng'
        ],
    ],

    //-------------------- donate --------------------//
    'donate' => [
        'title' => 'donate idol',
        'key' => 'donate',
        'url_trans' =>  env('URL_GG_SOUND'),
        'payment_type' => [
            '0' => 'Thanh toán bằng tài khoản',
            '1' => 'Thanh toán ngân hàng'
        ],
        'status' => [
            '0' => 'Thất bại',
            '1' => 'Thành công',
            '2' => 'Đang chờ thanh toán',
            '3' => 'Đã hủy',
        ],
        'effect' => [
            'flash' => 'flash',
            // 'zoomIn' => 'zoomIn'
        ],
        'effect_in' => [
            // 'flash' => 'flash',
            'zoomIn' => 'zoomIn'
        ],
        'effect_out' => [
            // 'flash' => 'flash',
            'zoomOut' => 'zoomOut'
        ],
        'voice_gg' => [
            '0' => 'Tắt',
            '1' => 'Bật'
        ],
    ],



    //-------------------- telecom --------------------//

    'telecom' => [
        'key'=>"telecom",
        'title'=>"Cài đặt nạp thẻ tự động",
        'status' => [
            '1' => 'Hoạt động',
            '0' => 'Ngừng hoạt động',
        ],

        'gate_id' => [
            '6' => 'NTN (with Callback)',
            '8' => 'CCC (with Callback)',
        ]

    ],



    //-------------------- telecom --------------------//

    'store-telecom' => [
        'key'=>"store-telecom",
        'title'=>"Cài đặt mua thẻ",
        'status' => [
            '1' => 'Hoạt động',
            '0' => 'Ngừng hoạt động',
        ],

        'gate_id' => [
            '1' => 'HQPAY',
        ]

    ],

    'store-card' => [
        'key'=>"store-card",
        'title'=>"Thống kê mua thẻ",
        'status' => [
            '0' => 'Thất bại',
            '1' => 'Thành công',
            '2' => 'Đang chờ',
            '3' => 'Đã hủy', // trường hợp này sau sẽ dùng cho thanh toán cổng thẻ
            '4' => 'Lỗi gọi nhà cung cấp',
            '5' => 'Lỗi hệ thống'
        ],

        'gate_id' => [
            '1' => 'HQPAY',
        ],

    ],

    //-------------------- gifcode --------------------//
    'gift-code' => [
        'key' => 'gift-code',
        'title' => 'Quản lý mã nhận thưởng',
        'status' => [
            1 => 'Hoạt động',
            0 => 'Ngừng hoạt động'
        ],
        'type' => [
            1 => 'Nhận tiền theo cấu hình tỷ lệ trúng thưởng (bằng đào)',
        ]
    ],
    'gift-code' => [
        'key' => 'gift-code-report',
        'title' => 'Thống kê nhận thưởng',
        'status' => [
            1 => 'Hoạt động',
            0 => 'Ngừng hoạt động'
        ],
        'type' => [
            1 => 'Nhận tiền theo cấu hình tỷ lệ trúng thưởng (bằng đào)',
        ]
    ],
    'charge_bank' => [
        'key' => 'charge_bank',
        'title' => 'Nạp tiền qua bank tự động',
        'status' => [
            '0' => 'Thất bại',
            '1' => 'Thành công',
            '2' => 'Đang chờ thanh toán',
            '3' => 'Đã hủy',
        ],
    ],
    'bank' => [
        'key' => 'bank',
        'title' => 'Ngân hàng',
        'status' => [
            '1' => 'Đang hoạt động',
            '0' => 'Ngừng hoạt động',
        ],
        'key_hash_password' => env('HASH_PASSWORD_BANK'),
        'key' => [
            'TECHCOMBANK' => "TECHCOMBANK",
        ]
    ],
    // rút tiền
    'withdraw-bank' => [
        'key' => 'withdraw-bank',
        'title' => 'Quản lý ngân hàng rút tiền',
        'status' => [
            '1' => 'Hoạt động',
            '0' => 'Ngừng hoạt động',
        ],
        'fee_type' => [
            '1' => 'Chiết khấu % theo từng lần rút'
        ]
    ],
    'withdraw' => [
        'key' => 'withdraw',
        'title' => 'Duyệt lệnh rút tiền',
        'status' => [
            '0' => 'Từ chối',
            '1' => 'Đã duyệt',
            '2' => 'Chờ duyệt',
        ],
    ],

    //-------------------- charge --------------------//

    'charge' => [
        'key'=>"charge",
        'title'=>"Nạp thẻ tự động",
        'status' => [
            '1' => 'Thẻ đúng',
            '0' => 'Thẻ sai',
            '2' => 'Chờ xử lý',
            '3' => 'Sai mệnh giá',
            '999' => 'Lỗi nạp thẻ',
            '-999' => 'Lỗi nạp thẻ',
            '-1' => 'Phát sinh lỗi nạp thẻ',
        ],

        'status-callback' => [
            '0' => 'Thẻ sai',
            '10000' => '10,000đ',
            '20000' => '20,000đ',
            '30000' => '30,000đ',
            '50000' => '50,000đ',
            '100000' => '100,000đ',
            '200000' => '200,000đ',
            '300000' => '300,000đ',
            '500000' => '500,000đ',
            '1000000' => '1,000,000đ',
            '2000000' => '2,000,000đ',
            '5000000' => '5,000,000đ',
        ],

        'key_encrypt' => env('ENCRYPT_CHARGING'),
        'gate_id' => [
            '6' => 'NTN (with Callback)',
            '8' => 'CCC (with Callback)',
        ],


    ],

    'plus_money' => [
        'is_add' => [
            '1' => 'Cộng tiền',
            '0' => 'Trừ tiền',
        ],
    ],

    'txns' => [

        'trade_type' => [
            'charge' => 'Nạp thẻ tự động',
            'transfer_money' => 'Chuyển tiền',
            'receive_money' => 'Nhận tiền',
            'withdraw_money' => 'Rút tiền',
            'plus_money' => 'Cộng tiền',
            'minus_money' => 'Trừ tiền',
            'booking' => 'Booking',
            'donate' => 'Donate',
            'gift_code' => 'Nhận thưởng',
            'withdraw' => 'Rút tiền',
        ],
        'status' => [
            '0' => 'Không thành công',
            '1' => 'Thành công',
            '2' => 'Chờ xử lý',

        ],
        'is_add' => [
            '1' => 'Cộng tiền',
            '0' => 'Trừ tiền'
        ],
    ],






];





//demo params fields
//
//'params_field'=>[
//
//    [
//        'label' => 'Tiêu đề trang', // you know what label it is
//        'name' => 'params[text]', // unique name for field
//        'type' => 'text', // input fields type
//        'data' => 'string', // data type, string, int, boolean
//        'rules' => '', // validation rule of laravel
//        'div_parent_class' => 'col-12 col-md-12', // div parent class for input
//        'class' => '', // any class for input
//        'value' => 'demo' // default value if you want
//    ],
//
//    [
//        'label' => 'Demo Checkbox', // you know what label it is
//        'name' => 'params[checkbox]', // unique name for field
//        'type' => 'text', // input fields type
//        'data' => 'string', // data type, string, int, boolean
//        'rules' => '', // validation rule of laravel
//        'div_parent_class' => 'col-12 col-md-12', // div parent class for input
//        'class' => '', // any class for input
//        'value' => '' // default value if you want
//    ],
//    [
//        'label' => 'Demo ckeditor', // you know what label it is
//        'name' => 'params[ckeditor]', // unique name for field
//        'type' => 'ckeditor', // input fields type
//        'data' => '', // data type, string, int, boolean
//        'rules' => '', // validation rule of laravel
//        'div_parent_class' => 'col-12 col-md-12', // div parent class for input
//        'class' => '', // any class for input
//        'value' => '', // default value if you want
//        'height' => '400' // default height if you want
//
//    ],
//
//    [
//        'label' => 'Demo ckeditor-source', // you know what label it is
//        'name' => 'params[ckeditor-source]', // unique name for field
//        'type' => 'ckeditor-source', // input fields type
//        'data' => '', // data type, string, int, boolean
//        'rules' => '', // validation rule of laravel
//        'div_parent_class' => 'col-12 col-md-12', // div parent class for input
//        'class' => '', // any class for input
//        'value' => '', // default value if you want
//        'height' => '400' // default height if you want ckfinder
//
//    ],
//
//    [
//        'label' => 'Demo image', // you know what label it is
//        'name' => 'params[image]', // unique name for field
//        'type' => 'image', // input fields type
//        'data' => '', // data type, string, int, boolean
//        'rules' => '', // validation rule of laravel
//        'div_parent_class' => 'col-12 col-md-12', // div parent class for input
//        'class' => '', // any class for input
//        'value' => '', // default value if you want
//        'height' => '' // default height if you want ckfinder
//
//    ],
//    [
//        'label' => 'Demo image', // you know what label it is
//        'name' => 'params[image]', // unique name for field
//        'type' => 'image', // input fields type
//        'data' => '', // data type, string, int, boolean
//        'rules' => '', // validation rule of laravel
//        'div_parent_class' => 'col-12 col-md-12', // div parent class for input
//        'class' => '', // any class for input
//        'value' => '', // default value if you want
//        'height' => '' // default height if you want ckfinder
//
//    ],
//
//    [
//        'label' => 'Demo number ', // you know what label it is
//        'name' => 'params[number]', // unique name for field
//        'type' => 'number', // input fields type
//        'data' => '', // data type, string, int, boolean
//        'rules' => '', // validation rule of laravel
//        'div_parent_class' => 'col-12 col-md-12', // div parent class for input
//        'class' => '', // any class for input
//        'value' => 'demo', // default value if you want
//        'height' => '' // default height if you want ckfinder
//
//    ],
//
//    [
//        'label' => 'Demo select', // you know what label it is
//        'name' => 'params[select]', // unique name for field
//        'type' => 'select', // input fields type
//        'data' => '', // data type, string, int, boolean
//        'rules' => '', // validation rule of laravel
//        'div_parent_class' => 'col-12 col-md-12', // div parent class for input
//        'class' => '', // any class for input
//        'value' => 'demo', // default value if you want
//        'height' => '', // default height if you want ckfinder
//        'options' => [
//            0 => "Có",
//            1 => "Không"
//        ] // default height if you want ckfinder
//
//
//    ],
//
//
//    [
//          Chia cột theo gird
//        [
//            'label' => 'Demo Checkbox', // you know what label it is
//            'name' => 'params[checkbox-group]', // unique name for field
//            'type' => 'checkbox', // input fields type
//            'data' => 'string', // data type, string, int, boolean
//            'rules' => '', // validation rule of laravel
//            'div_parent_class' => 'col-12 col-md-4', // div parent class for input
//            'class' => '', // any class for input
//            'value' => 'demo' // default value if you want
//        ],
//        [
//            'label' => 'Demo checkbox', // you know what label it is
//            'name' => 'params[checkbox-group]', // unique name for field
//            'type' => 'checkbox', // input fields type
//            'data' => 'string', // data type, string, int, boolean
//            'rules' => '', // validation rule of laravel
//            'div_parent_class' => 'col-12 col-md-4', // div parent class for input
//            'class' => '', // any class for input
//            'value' => 'demo' // default value if you want
//        ],
//        [
//            'label' => 'Demo ', // you know what label it is
//            'name' => 'params[checkbox-group]', // unique name for field
//            'type' => 'checkbox', // input fields type
//            'data' => 'string', // data type, string, int, boolean
//            'rules' => '', // validation rule of laravel
//            'div_parent_class' => 'col-12 col-md-4', // div parent class for input
//            'class' => '', // any class for input
//            'value' => 'demo' // default value if you want
//        ]
//    ]
//
//],
//
