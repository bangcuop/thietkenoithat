<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/responsive.css',
        'css/font-awesome.css',
        'css/sprite.css',
        'css/content.css',
        'js/lib/jqueryui/jqueryui.css',
    ];
    public $js = [
        'js/lib/jquery/migrate.js',
        'js/lib/jqueryui/jqueryui.js',
        'js/lib/bootstrap.js',
        'js/plugins/lazyload/lazyload.min.js',
        'js/lib/ajax.js',
        'js/lib/tmpl.js',
        'js/lib/popup.js',
        'js/lib/ejs.js',
        'js/lib/jquery.dataTables.js',
        'js/lib/jqueryui/timepicker.js',
        'js/lib/timeselect.js',
        'js/lib/ckeditor/ckeditor.js',
        'js/lib/angular/angular.js',
        'js/lib/fly.js',
        'js/lib/textUtils.js',
        'js/lib/viewUtils.js',
        'js/style.js',
        'js/layout.js',
        'js/administrator.js',
        'js/func.js',
        'js/auth.js',
        'js/index.js',
        'js/item.js',
        'js/news.js',
        'js/image.js',
        'js/category.js',
        'js/city.js',
        'js/banner.js',
        'js/contact.js',
        'js/urlsUtils.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public function init() {
        parent::init();
    }

}
