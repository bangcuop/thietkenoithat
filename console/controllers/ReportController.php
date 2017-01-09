<?php

namespace console\controllers;

use common\models\business\ReportBusiness;
use common\util\TextUtils;

class ReportController extends ConsoleController {

    public function actionOrder() {
        ReportBusiness::getCronjobOrder();
    }

    public function actionCheck() {
        $timeReport = 1420563600;
        for ($index = 0; $index < 65; $index++) {
            ReportBusiness::getCronjobOrder($timeReport);
            $timeReport+= 86400;
            echo "Thống kê thành công";
        }
    }

}
