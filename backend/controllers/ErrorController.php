<?php

use frontend\controllers\BaseController;

namespace backend\controllers;

class ErrorController extends BaseController {

    public function actions() {
        return [
            'action' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function action404() {
        echo "404";
    }

    public function action500() {
        return $this->render("500");
    }

}
