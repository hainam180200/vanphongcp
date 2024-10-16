<?php

return [

    'system' => [
        'title' => 'Thông tin website',
        'desc' => '',
        'icon' => 'm-menu__link-icon flaticon-settings',
        'class' => 'active show',

        'elements' => [
            [
                'label' => 'Tiêu đề trang', // you know what label it is
                'name' => 'sys_title', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],

            [
                'label' => 'Mô tả', // you know what label it is
                'name' => 'sys_description', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'label' => 'Từ khóa', // you know what label it is
                'name' => 'sys_keyword', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'label' => 'Địa chỉ', // you know what label it is
                'name' => 'sys_address', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'label' => 'Điện thoại', // you know what label it is
                'name' => 'sys_phone', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'label' => 'Email liên hệ', // you know what label it is
                'name' => 'sys_mail', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'label' => 'Link fanpage Facebook', // you know what label it is
                'name' => 'sys_fanpage', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],

            [
                'label' => 'Link Youtube', // you know what label it is
                'name' => 'sys_youtube', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'label' => 'Link Twitter', // you know what label it is
                'name' => 'sys_twitter', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'label' => 'Link fanpage G+', // you know what label it is
                'name' => 'sys_google_plus', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'label' => 'Link Tiktok', // you know what label it is
                'name' => 'sys_tiktok', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'label' => 'Link Zalo', // you know what label it is
                'name' => 'sys_zalo', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'label' => 'Link Instagram', // you know what label it is
                'name' => 'sys_instagram', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'label' => 'Hiển thị popup trang chủ', // you know what label it is
                'name' => 'sys_active_popup', // unique name for field
                'type' => 'select', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
                'options' => [
                    '0' => 'Tắt',
                    '1' => 'Bật'
                ]
            ],
            [
                'label' => 'Nội dung footer desktop', // you know what label it is
                'name' => 'sys_footer_desktop', // unique name for field
                'type' => 'ckeditor_source', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-3', // any class for input
                'value' => '', // default value if you want
            ],
            [
                'label' => 'Nội dung footer mobile', // you know what label it is
                'name' => 'sys_footer_mobile', // unique name for field
                'type' => 'ckeditor_source', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-3', // any class for input
                'value' => '', // default value if you want
            ],
            [
                'label' => 'Chat Message Facebook', // you know what label it is
                'name' => 'sys_message', // unique name for field
                'type' => 'textarea', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
            ],
            [
                'label' => 'Schema Index', // you know what label it is
                'name' => 'sys_schema', // unique name for field
                'type' => 'textarea', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
            ],
            [
                'label' => 'Thời gian kết thúc flash sales', // you know what label it is
                'name' => 'sys_flash_sales_ended_at', // unique name for field
                'type' => 'datetimepicker_source', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => 'datetimepicker-input datetimepicker-default', // any class for input
                'value' => '', // default value if you want,
                'data-toggle' => 'datetimepicker',
                'autocomplete' => 'off',
                'placeholder' => 'Thời gian kết thúc'
            ],
            [
                'label' => 'Nội dung section mô tả trang chủ (desktop)', // you know what label it is
                'name' => 'sys_intro_text_desktop', // unique name for field
                'type' => 'ckeditor_source', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-3', // any class for input
                'value' => '', // default value if you want
            ],
            [
                'label' => 'Nội dung section mô tả trang chủ (mobile)', // you know what label it is
                'name' => 'sys_intro_text_mobile', // unique name for field
                'type' => 'ckeditor_source', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-3', // any class for input
                'value' => '', // default value if you want
            ],
            [
                'label' => 'Ảnh logo', // you know what label it is
                'name' => 'sys_logo', // unique name for field
                'type' => 'image', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-3', // any class for input
                'value' => '', // default value if you want
            ],
            [
                'label' => 'Ảnh favicon', // you know what label it is
                'name' => 'sys_favicon', // unique name for field
                'type' => 'image', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-3', // any class for input
                'value' => '', // default value if you want
            ],
            [
                'label' => 'Ảnh Popup trang chủ', // you know what label it is
                'name' => 'sys_popup_image', // unique name for field
                'type' => 'image', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-3', // any class for input
                'value' => '', // default value if you want
            ],
            [
                'label' => 'Ảnh nền website', // you know what label it is
                'name' => 'sys_background', // unique name for field
                'type' => 'image', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-3', // any class for input
                'value' => '', // default value if you want
            ],
            [
                'label' => 'Màu nền', // you know what label it is
                'name' => 'sys_color', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-3', // any class for input
                'value' => '', // default value if you want
            ],
        ]
    ],
    'widget' => [
        'title' => 'Nội dung hiển thị trang chủ',
        'desc' => '',
        'icon' => 'm-menu__link-icon flaticon-interface-6',
        'elements' => [
            [
                'label' => 'ID nhóm danh mục Flash Sale', // you know what label it is
                'name' => 'sys_widget_flash_sale', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'label' => 'ID nhóm danh mục quảng cáo 1 (Dưới banner ADS 1)', // you know what label it is
                'name' => 'sys_id_widget_1', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'label' => 'Tên nhóm danh mục quảng cáo 1 (Dưới banner ADS 1)', // you know what label it is
                'name' => 'sys_name_widget_1', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'label' => 'ID nhóm danh mục quảng cáo 2 (Dưới banner ADS 2)', // you know what label it is
                'name' => 'sys_id_widget_2', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'label' => 'Tên nhóm danh mục quảng cáo 2 (Dưới banner ADS 2)', // you know what label it is
                'name' => 'sys_name_widget_2', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'label' => 'ID nhóm danh mục quảng cáo 3 (Dưới banner ADS 3)', // you know what label it is
                'name' => 'sys_id_widget_3', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'label' => 'Tên nhóm danh mục quảng cáo 3 (Dưới banner ADS 3)', // you know what label it is
                'name' => 'sys_name_widget_3', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'label' => 'ID danh mục bài viết xuất hiện tại trang chủ  (nếu có nhiều thì ngăn cách bằng dấu phẩy)', // you know what label it is
                'name' => 'sys_id_widget_article', // unique name for field
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '' // default value if you want
            ],
        ]
    ],
    // 'email' => [
    //     'title' => 'Email',
    //     'desc' => '',
    //     'icon' => 'm-menu__link-icon flaticon-email',

    //     'elements' => [

    //         [
    //             'label' => 'Máy chủ', // you know what label it is
    //             'name' => 'sys_email_host', // unique name for field
    //             'type' => 'text', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => '', // any class for input
    //             'value' => '' // default value if you want
    //         ],

    //         [
    //             'label' => 'Port', // you know what label it is
    //             'name' => 'sys_email_port', // unique name for field
    //             'type' => 'text', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => '', // any class for input
    //             'value' => '' // default value if you want
    //         ],

    //         [
    //             'label' => 'Tài khoản', // you know what label it is
    //             'name' => 'sys_email_username', // unique name for field
    //             'type' => 'text', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => '', // any class for input
    //             'value' => '' // default value if you want
    //         ],

    //         [
    //             'label' => 'Mật khẩu', // you know what label it is
    //             'name' => 'sys_email_password', // unique name for field
    //             'type' => 'text', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => '', // any class for input
    //             'value' => '' // default value if you want
    //         ],

    //     ]
    // ],
    // 'code' => [
    //     'title' => 'Mã nhúng script',
    //     'desc' => '',
    //     'icon' => 'm-menu__link-icon flaticon-responsive',

    //     'elements' => [

    //         [
    //             'label' => 'Google Analytics', // you know what label it is
    //             'name' => 'sys_code_ga', // unique name for field
    //             'type' => 'text', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => '', // any class for input
    //             'value' => '' // default value if you want
    //         ],

    //         [
    //             'label' => 'Chatbox', // you know what label it is
    //             'name' => 'sys_code_chatbox', // unique name for field
    //             'type' => 'text', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => '', // any class for input
    //             'value' => '' // default value if you want
    //         ],
    //         [
    //             'label' => 'Google map', // you know what label it is
    //             'name' => 'sys_code_ggmap', // unique name for field
    //             'type' => 'text', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => '', // any class for input
    //             'value' => '' // default value if you want
    //         ],

    //         [
    //             'label' => 'Mã khác', // you know what label it is
    //             'name' => 'sys_code_other', // unique name for field
    //             'type' => 'text', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => '', // any class for input
    //             'value' => '' // default value if you want
    //         ],
    //         [
    //             'label' => 'Sitemap', // you know what label it is
    //             'name' => 'sys_sitemap', // unique name for field
    //             'type' => 'textarea', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => '', // any class for input
    //             'value' => '' // default value if you want
    //         ],

    //     ]
    // ],

    // 'cache' => [
    //     'title' => 'Quản lý cache',
    //     'desc' => '',
    //     'icon' => 'm-menu__link-icon flaticon-more-v4',

    //     'elements' => [

    //         [
    //             'label' => 'Active cache', // you know what label it is
    //             'name' => 'sys_cache_ative', // unique name for field
    //             'type' => 'checkbox', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => '', // any class for input
    //             'value' => '' // default value if you want
    //         ],

    //         [
    //             'label' => 'Thời gian cache', // you know what label it is
    //             'name' => 'sys_cache_time', // unique name for field
    //             'type' => 'text', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => '', // any class for input
    //             'value' => '' // default value if you want
    //         ],


    //     ]
    // ],

    // 'sitemap' => [
    //     'title' => 'Quản lý sitemap',
    //     'desc' => '',
    //     'icon' => 'm-menu__link-icon flaticon-network',

    //     'elements' => [

    //         [
    //             'label' => 'File Sitemap', // you know what label it is
    //             'name' => 'sys_sitemap_file', // unique name for field
    //             'type' => 'text', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => '', // any class for input
    //             'value' => '' // default value if you want
    //         ],

    //         [
    //             // dùng ace_editor để khung viết code
    //             'label' => 'Nội dung file sitemap.xml', // you know what label it is
    //             'name' => 'sys_sitemap_content', // unique name for field
    //             'type' => 'text', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => '', // any class for input
    //             'value' => '' // default value if you want
    //         ],


    //     ]
    // ],

    // 'robots' => [
    //     'title' => 'Quản lý robots',
    //     'desc' => '',
    //     'icon' => 'm-menu__link-icon flaticon2-start-up',

    //     'elements' => [

    //         [
    //             'label' => 'File robots', // you know what label it is
    //             'name' => 'sys_robots_file', // unique name for field
    //             'type' => 'text', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => '', // any class for input
    //             'value' => '' // default value if you want
    //         ],

    //         [
    //             // dùng ace_editor để khung viết code
    //             'label' => 'Nội dung file robots.txt', // you know what label it is
    //             'name' => 'sys_robots_content', // unique name for field
    //             'type' => 'text', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => '', // any class for input
    //             'value' => '' // default value if you want
    //         ],


    //     ]
    // ],

    // 'messenger' => [
    //     'title' => 'Mã nhúng messenger',
    //     'desc' => '',
    //     'icon' => 'm-menu__link-icon flaticon-responsive',

    //     'elements' => [

    //         [
    //             'label' => 'Messenger plugin', // you know what label it is
    //             'name' => 'sys_messenger_plugin', // unique name for field
    //             'type' => 'text', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => '', // any class for input
    //             'value' => '' // default value if you want
    //         ],

    //         //[
    //         //    'label' => 'Chatbox', // you know what label it is
    //         //    'name' => 'sys_code_chatbox', // unique name for field
    //         //    'type' => 'text', // input fields type
    //         //    'data' => 'string', // data type, string, int, boolean
    //         //    'rules' => '', // validation rule of laravel
    //         //    'class' => '', // any class for input
    //         //    'value' => '' // default value if you want
    //         //],
    //         //[
    //         //    'label' => 'Google map', // you know what label it is
    //         //    'name' => 'sys_code_ggmap', // unique name for field
    //         //    'type' => 'text', // input fields type
    //         //    'data' => 'string', // data type, string, int, boolean
    //         //    'rules' => '', // validation rule of laravel
    //         //    'class' => '', // any class for input
    //         //    'value' => '' // default value if you want
    //         //],
    //         //
    //         //[
    //         //    'label' => 'Mã khác', // you know what label it is
    //         //    'name' => 'sys_code_other', // unique name for field
    //         //    'type' => 'text', // input fields type
    //         //    'data' => 'string', // data type, string, int, boolean
    //         //    'rules' => '', // validation rule of laravel
    //         //    'class' => '', // any class for input
    //         //    'value' => '' // default value if you want
    //         //],
    //         //[
    //         //    'label' => 'Sitemap', // you know what label it is
    //         //    'name' => 'sys_sitemap', // unique name for field
    //         //    'type' => 'textarea', // input fields type
    //         //    'data' => 'string', // data type, string, int, boolean
    //         //    'rules' => '', // validation rule of laravel
    //         //    'class' => '', // any class for input
    //         //    'value' => '' // default value if you want
    //         //],

    //     ]
    // ],

    // 'verifysite' => [
    //     'title' => 'Upload file xác thực website',
    //     'desc' => '',
    //     'icon' => 'm-menu__link-icon flaticon2-protected',

    //     'elements' => [

    //         [
    //             'label' => 'File robots', // you know what label it is
    //             'name' => 'sys_verifysite_file', // unique name for field
    //             'type' => 'text', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => '', // any class for input
    //             'value' => '' // default value if you want
    //         ],




    //     ]
    // ],

    // //Popup & Exit Popup
    // 'popup' => [
    //     'title' => 'Popup & Exit Popup ',
    //     'desc' => '',
    //     'icon' => 'm-menu__link-icon flaticon2-cube-1',

    //     'elements' => [

    //         [
    //             'label' => 'Hiển thị', // you know what label it is
    //             'name' => 'sys_popup_active', // unique name for field
    //             'type' => 'checkbox', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => '', // any class for input
    //             'value' => '' // default value if you want
    //         ],
    //         [
    //             'label' => 'Thời gian chờ trước khi hiển thị (giây)', // you know what label it is
    //             'name' => 'sys_popup_delay', // unique name for field
    //             'type' => 'number', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => 'col-md-6', // any class for input
    //             'value' => '' // default value if you want
    //         ],

    //         [
    //             'label' => 'Thời gian hiển thị lại popup', // you know what label it is
    //             'name' => 'sys_popup_frequency', // unique name for field
    //             'type' => 'select', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => 'col-md-6', // any class for input
    //             'value' => '', // default value if you want
    //             'options' => [
    //                 'always' => 'Luôn luôn xuất hiện khi truy cập vào trang',
    //                 'onetime' => 'Hiển thị sau mỗi khoảng thời gian'
    //             ]
    //         ],

    //         [
    //             'label' => 'Thời gian hiển thị lại popup', // you know what label it is
    //             'name' => 'sys_popup_cookieExpire', // unique name for field
    //             'type' => 'number', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => 'col-md-6', // any class for input
    //             'value' => '' // default value if you want

    //         ],

    //         [
    //             // dùng ace_editor để khung viết code
    //             'label' => 'Nội dung popup', // you know what label it is
    //             'name' => 'sys_popup_content', // unique name for field
    //             'type' => 'ckeditor_source', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => '', // any class for input
    //             'value' => '' // default value if you want
    //         ],


    //     ]
    // ],

    // 'comment' => [
    //     'title' => 'Cấu hình bình luận',
    //     'desc' => '',
    //     'icon' => 'm-menu__link-icon flaticon2-chat-2',

    //     'elements' => [

    //         [
    //             'label' => 'Hiển thị', // you know what label it is
    //             'name' => 'sys_comment_ative', // unique name for field
    //             'type' => 'checkbox', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => '', // any class for input
    //             'value' => '' // default value if you want
    //         ],
    //         [
    //             'label' => 'Loại comment', // you know what label it is
    //             'name' => 'sys_comment_type', // unique name for field
    //             'type' => 'select', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => 'col-md-6', // any class for input
    //             'value' => '', // default value if you want
    //             'options' => [
    //                 '1' => 'Bình luận của hệ thống',
    //                 '2' => 'Bình luận của facebook'
    //             ]
    //         ],

    //         [
    //             'label' => 'Bình luận phải chờ được kiểm duyệt', // you know what label it is
    //             'name' => 'sys_comment_censorship', // unique name for field
    //             'type' => 'checkbox', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => '', // any class for input
    //             'value' => '' // default value if you want
    //         ],
    //         [
    //             'label' => 'Cho phép đánh giá', // you know what label it is
    //             'name' => 'sys_comment_review', // unique name for field
    //             'type' => 'checkbox', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => '', // any class for input
    //             'value' => '' // default value if you want
    //         ],
    //         [
    //             'label' => 'Cho phép hiển thị đánh giá ở trang danh sách', // you know what label it is
    //             'name' => 'sys_comment_start_list', // unique name for field
    //             'type' => 'checkbox', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => '', // any class for input
    //             'value' => '' // default value if you want
    //         ],
    //         [
    //             'label' => 'Gửi email thông báo cho admin khi có bình luận mới', // you know what label it is
    //             'name' => 'sys_comment_email_to_admin', // unique name for field
    //             'type' => 'checkbox', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => '', // any class for input
    //             'value' => '' // default value if you want
    //         ],

    //         [
    //             'label' => 'Hình ảnh đại diện mặc định', // you know what label it is
    //             'name' => 'sys_comment_avatar', // unique name for field
    //             'type' => 'select', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => 'col-md-6', // any class for input
    //             'value' => '', // default value if you want
    //             'options' => [
    //                 '1' => 'Ảnh 1',
    //                 '2' => 'Ảnh 2',
    //                 '3' => 'Ảnh 3',

    //             ]
    //         ],
    //     ]
    // ],

    // 'maintenance' => [
    //     'title' => 'Bảo trì website',
    //     'desc' => '',
    //     'icon' => 'm-menu__link-icon flaticon-lifebuoy',

    //     'elements' => [
    //         [
    //             'label' => 'Trạng thái', // you know what label it is
    //             'name' => 'sys_maintenance_status', // unique name for field
    //             'type' => 'select', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => 'col-md-6', // any class for input
    //             'value' => '1', // default value if you want
    //             'options' => [
    //                 '1' => 'Hoạt động',
    //                 '0' => 'Bảo trì'
    //             ]
    //         ],
    //         [
    //             'label' => 'Thông báo khi website bảo trì', // you know what label it is
    //             'name' => 'sys_maintenance_content', // unique name for field
    //             'type' => 'ckeditor_source', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => 'col-md-6', // any class for input
    //             'value' => '', // default value if you want

    //         ],
    //     ]
    // ],

    // 'redirect301' => [
    //     'title' => 'Điều hướng 301',
    //     'desc' => '',
    //     'icon' => 'm-menu__link-icon flaticon2-browser-2',

    //     //cái này làm 2 cột: 1. link gôc 2. link muốn chuyển hướng
    //     'elements' => [
    //         [
    //             'label' => 'Link', // you know what label it is
    //             'name' => '', // unique name for field
    //             'type' => 'text', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => 'col-md-6', // any class for input
    //             'value' => 'Đang hoàn thiện', // default value if you want

    //         ],

    //     ]
    // ],

    // 'add_domain' => [
    //     'title' => 'Cấu hình tên miền',
    //     'desc' => '',
    //     'icon' => 'm-menu__link-icon flaticon2-layers-2',

    //     //cái này làm 2 cột: 1. link gôc 2. link muốn chuyển hướng
    //     'elements' => [
    //         [
    //             'label' => 'Link', // you know what label it is
    //             'name' => 'sys_add_domain_link', // unique name for field
    //             'type' => 'text', // input fields type
    //             'data' => 'string', // data type, string, int, boolean
    //             'rules' => '', // validation rule of laravel
    //             'class' => 'col-md-6', // any class for input
    //             'value' => 'Đang hoàn thiện', // default value if you want

    //         ],

    //     ]
    // ],
];


