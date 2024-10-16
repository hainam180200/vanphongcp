<?php

use  Illuminate\Contracts\Container\Container;

// Aside menu
return [

    'items' => [
        // Dashboard
        [
            'title' => 'Dashboard',
            'root' => true,
            'permission' => '',
            'icon' => 'assets/backend/themes/media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'route' => 'admin.index',
            'page' => '',
            'new-tab' => false,
        ],
        [
            'title' => 'Thông tin tài khoản',
            'root' => true,
            'icon' => 'far fa-user-circle', // or can be 'flaticon-home' or any flaticon-*
            'route' => 'admin.profile',
            'page' => '',
            'new-tab' => false,
        ],
        [
            'section' => 'Bài viết',
        ],
        [
            'title' => 'Quản lý bài viết',
            'desc' => '',
            'icon' => 'flaticon-notes',
            'bullet' => 'dot',
            'permission' => 'article',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Tất cả bài viết',
                    'route' => 'admin.article.index',
                    'page' => '',
                ],
                [
                    'title' => 'Danh mục bài viết',
                    'route' => 'admin.article-category.index',
                    'page' => ''
                ],
            ]
        ],
        [
            'section' => 'Quảng cáo',
        ],
        [
            'title' => 'Quản lý quảng cáo',
            'desc' => '',
            'icon' => 'flaticon-multimedia-3',
            'bullet' => 'dot',
            'permission' => 'advertise',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Tất cả quảng cáo',
                    'route' => 'admin.advertise.index',
                    'page' => '',
                ],
            ]
        ],
        [
            'section' => 'Sản phẩm',
        ],
        [
            'title' => 'Quản lý sản phẩm',
            'desc' => '',
            'icon' => 'flaticon-multimedia-3',
            'bullet' => 'dot',
            'permission' => 'advertise',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Nhóm sản phẩm',
                    'route' => 'admin.product-group.index',
                    'page' => ''
                ],
                [
                    'title' => 'Danh mục sản phẩm',
                    'route' => 'admin.product-category.index',
                    'page' => ''
                ],
                [
                    'title' => 'Quản lý sản phẩm',
                    'route' => 'admin.product.index',
                    'page' => '',
                ],
                [
                    'title' => 'Quản lý thuộc tính',
                    'route' => 'admin.product-attribute.index',
                    'page' => '',
                ],
            ]
        ],
        [
            'section' => 'Đơn hàng',
        ],
        [
            'title' => 'Thống kê đơn hàng',
            'icon' => 'fab fa-get-pocket',
            'bullet' => 'line',
            'route' => 'admin.order.index',
            'page' => ''

        ],
        [
            'section' => 'Bình luận',
        ],
        [
            'title' => 'Quản lý bình luận',
            'icon' => 'fab fa-get-pocket',
            'bullet' => 'line',
            'route' => 'admin.comment.index',
            'page' => ''

        ],
        [
            'section' => 'Quản lý trả góp',
        ],
        [
            'title' => 'Đơn vị trả góp',
            'icon' => 'fab fa-creative-commons-nc',
            'bullet' => 'line',
            'route' => 'admin.installment.index',
            'page' => ''
        ],
        [
            'title' => 'Yêu cầu trả góp',
            'icon' => 'far fa-money-bill-alt',
            'bullet' => 'line',
            'route' => 'admin.installment-report.index',
            'page' => ''
        ],
        [
            'section' => 'Hệ thống',
        ],
        [
            'title' => 'Nhóm vai trò',
            'icon' => 'fas fa-crown',
            'bullet' => 'line',
            'route' => 'admin.role.index',
            'page' => ''

        ],
        [
            'title' => 'Danh sách QTV',
            'icon' => 'fas fa-user-cog',
            'bullet' => 'line',
            'permission' => 'user-qtv',
            'route' => 'admin.user-qtv.index',
            'page' => ''

        ],
        [
            'title' => 'Danh sách thành viên',
            'icon' => 'fas fa-user',
            'bullet' => 'line',
            'permission' => 'user',
            'route' => 'admin.user.index',
            'page' => ''

        ],
        [
            'title' => 'Cấu hình menu top',
            'icon' => 'flaticon-menu-1',
            'bullet' => 'line',
            'permission' => 'user',
            'route' => 'admin.menutop-category.index',
            'page' => ''

        ],
        [
            'title' => 'Cấu hình menu chính',
            'icon' => 'flaticon-grid-menu',
            'bullet' => 'line',
            'permission' => 'user',
            'route' => 'admin.menu-category.index',
            'page' => ''

        ],
        [
            'title' => 'Cấu hình menu blog',
            'icon' => 'fab fa-connectdevelop',
            'bullet' => 'line',
            'permission' => 'user',
            'route' => 'admin.menublog-category.index',
            'page' => ''

        ],
        [
            'title' => 'Quyền truy cập',
            'icon' => 'assets/backend/themes/media/svg/icons/Code/Git4.svg',
            'bullet' => 'line',
            'route' => 'admin.permission.index',
            'page' => ''

        ],
        [
            'title' => 'Log hoạt động',
            'icon' => 'assets/backend/themes/media/svg/icons/Devices/Diagnostics.svg',
            'bullet' => 'line',
            'route' => 'admin.activity-log.index',
            'page' => ''

        ],
        [
            'title' => 'Cấu hình hệ thống',
            'icon' => 'assets/backend/themes/media/svg/icons/Code/Settings4.svg',
            'bullet' => 'line',
            'route' => 'admin.setting.index',
            'page' => ''

        ],
    ]

];
