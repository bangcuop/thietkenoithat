<?php
namespace common\models\business;

use common\models\db\Design;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DesignBusiness
 *
 * @author liemnh
 */
class DesignBusiness {
    //put your code here
    public static function get($id) {
        return Design::findOne($id);
    }
}
