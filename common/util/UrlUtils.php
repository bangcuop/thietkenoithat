<?php

namespace common\util;

use common\models\input\ItemSearch;
use Yii;
use yii\helpers\Url;

class UrlUtils {

    static function category($id = null, $name, $base = true) {
        if ($id == null) {
            return Url::base($base) . '/san-pham.html';
        }
        return Url::base($base) . '/' . TextUtils::removeMarks($name) . '-c' . $id;
    }

    static function item($id, $name, $base = true) {
        return Url::base($base) . '/' . TextUtils::removeMarks($name) . '-i' . $id;
    }

    static function news($base = true) {
        return Url::base($base) . '/tin-tuc.html';
    }

    static function newDetail($id = null, $name, $base = true) {
        if ($id == null) {
            return Url::base($base) . '/tin-tuc.html';
        }
        return Url::base($base) . '/' . TextUtils::removeMarks($name) . '-n' . $id . '.html';
    }

    static function contact($base = true) {
        return Url::base($base) . '/lien-he.html';
    }

    static function about($base = true) {
        return Url::base($base) . '/gioi-thieu.html';
    }

}
