<?php

namespace console\controllers;

use yii\console\Controller;

class ConsoleController extends Controller {

    /**
     * 
     * @param type $url
     * @return type
     */
    protected static function get($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
//        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result);
    }

}
