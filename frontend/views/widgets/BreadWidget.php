<?php

namespace frontend\views\widgets;
use common\models\business\CategoryBusiness;

/**
 * Created by PhpStorm.
 * User: quan
 * Date: 4/27/16
 * Time: 12:35 AM
 */

class BreadWidget extends \yii\base\Widget
{
    public $id;

    public function run()
    {
        return $this->render('bread', [
            'data' => CategoryBusiness::getCategoryPath($this->id)
        ]);
    }

}