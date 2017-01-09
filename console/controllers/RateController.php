<?php

namespace console\controllers;

use common\models\business\RateBusiness;
use IntlCalendar;

class RateController extends ConsoleController {

    public function actionGet() {
        RateBusiness::getRateByService();
    }
    public function actionTest() {
        $cal = IntlCalendar::fromDateTime(date('h:i:s m/d/Y', time()));
		print_r($cal);
    }

}
