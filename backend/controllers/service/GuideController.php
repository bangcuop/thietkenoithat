<?php
namespace backend\controllers\service;
use common\models\db\Guide;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GuideController
 *
 * @author liemnh
 */
class GuideController {
    //put your code here
     public function init() {
        parent::init();
        $this->controller = Guide::getTableSchema()->name;
    }
}
