<?php

namespace common\models\business;
use common\models\db\Architecture;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArchitectureBusiness
 *
 * @author liemnh
 */
class ArchitectureBusiness {

    //put your code here
    public static function get($id) {
        return Architecture::findOne($id);
    }

}
