<?php
namespace common\models\business;
use common\models\db\Guide;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GuideBusiness
 *
 * @author liemnh
 */
class GuideBusiness {
    //put your code here
     public static function get($id) {
        return Guide::findOne($id);
    }
}
