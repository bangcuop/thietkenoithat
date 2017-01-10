<?php

/**
 * Created by PhpStorm.
 * User: quan
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

class FrontendAsset extends AssetBundle {

    public $sourcePath = '@frontend/assets/';
    public $css = [
        'css/animate.css',
        'css/bootstrap.min.css',
        'css/font.css',
        'css/bootstrap.min.css',
        'css/font-awesome.min.css',
        'css/jquery.fancybox.css',
        'css/li-scroller.css',
        'css/slick.css',
        'css/theme.css',
        'css/style.css',
    ];
    public $js = [
        'js/jquery.min.js',
        'js/wow.min.js',
        'js/bootstrap.min.js',
        'js/slick.min.js',
        'js/jquery.li-scroller.1.0.js',
        'js/jquery.newsTicker.min.js',
        'js/jquery.fancybox.pack.js',
        'js/custom.js',
    ];
    public $depends = [
    ];
    public $jsOptions = [
        'position' => View::POS_END
    ];

}
