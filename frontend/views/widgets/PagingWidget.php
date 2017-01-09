<?php

namespace frontend\views\widgets;

/**
 * Created by PhpStorm.
 * User: quan
 * Date: 4/27/16
 * Time: 12:35 AM
 */

class PagingWidget extends \yii\base\Widget
{
    public $page, $size, $count;

    public function run()
    {
        return $this->render('paging', [
            'page' => $this->page,
            'size' => $this->size,
            'count' => $this->count,
        ]);
    }

}