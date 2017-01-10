<?php

namespace backend\controllers\service;

use common\models\db\Architecture;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArchitectureController
 *
 * @author liemnh
 */
class ArchitectureController {

    //put your code here
    public function init() {
        parent::init();
        $this->controller = Architecture::getTableSchema()->name;
    }

}
