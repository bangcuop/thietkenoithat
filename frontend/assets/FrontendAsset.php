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
        'css/bootstrap.css',
        'css/style.css',
        'css/megamenu.css',
        'css/bootstrap.css',
        'css/form.css',
        'css/jquery-ui.css',
        'css/etalage.css',
        'css/font-awesome.min.css',
    ];
    public $js = [
        'js/jquery-1.11.1.min.js',
        'js/megamenu.js',
        'js/menu_jquery.js',
        'js/simpleCart.min.js',
        'js/responsiveslides.min.js',
        'js/jquery.flexisel.js',
        'js/jquery.etalage.min.js',
        'js/custom.js',
    ];
    public $depends = [
    ];
    public $jsOptions = [
        'position' => View::POS_END
    ];

}
