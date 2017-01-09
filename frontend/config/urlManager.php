<?php

return [
    'class' => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        //---default index
        '' => 'index/index',
        'index.php' => 'index/index',
        'index.html' => 'index/index',
        'san-pham.html' => 'product/category',
        'tin-tuc.html' => 'news/browse',
        'lien-he.html' => 'contact/contact',
        'gioi-thieu.html' => 'about/about',
        '<name:[0-9a-z_-]+>-n<id:\d+>.html' => 'news/detail',
        'GET s/<keyword:(.+)>' => 'product/category',
        'GET <name:[0-9a-z_-]+>-c<id:[0-9]+>' => 'product/category',
        'GET <name:[0-9a-z_-]+>-i<id:(.+)>' => 'product/detail',
//        //---Đăng nhập/ đăng ký
//        'GET dang-nhap.html' => 'auth/signin',
//        'GET dang-xuat.html' => 'auth/sigout',
//        'GET openId.html' => 'auth/opentid',
//        //---News
//        'GET tin-tuc.html' => 'news/index',
//        'GET tin-tuc/<alias:[0-9a-z_-]+>' => 'news/browse',
//        'GET tin-tuc/<alias:[0-9a-z_-]+>.html' => 'news/detail',
//        //---search
//        'GET s/<keyword:(.+)>.html' => 'search/index',
//        'GET tim-kiem.html' => 'search/search',
//        //--- sản phẩm
//        'GET p/<alias:[0-9a-z_-]+>-<id:\d+>.html' => 'item/detail',
//        //---danh mục sản phẩm
//        'GET danh-muc-san-pham.html' => 'browse/index',
//        'GET p/<alias:[0-9a-z_-]+>' => 'browse/detail',
//        //--- tài khoản
//        'GET u/thong-tin-tai-khoan.html' => 'user/index',
//        'GET u/don-hang.html' => 'user/order',
//        //--- thương hiệu
//        'GET thuong-hieu.html' => 'brand/index',
//        'GET thuong-hieu/<alias:[0-9a-z_-]+>.html' => 'brand/detail',
//        //--- checkout
//        'GET dat-hang.html' => 'order/index',
//        'GET thanh-toan-<id:[0-9]+>.html' => 'order/payment',
//        'GET thanh-toan-thu-them-<id:[0-9]+>.html' => 'order/paymentfeemore',
//        'GET chi-tiet-don-hang-<id:[0-9]+>.html' => 'order/detail',
    ],
];
