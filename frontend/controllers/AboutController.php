<?php

namespace frontend\controllers;

use common\models\business\NewsBusiness;

class AboutController extends BaseController {

    function actionAbout() {
        $new = NewsBusiness::getNewsAbout();
        return $this->render('index', [
                    "new" => $new,
        ]);
    }

}
