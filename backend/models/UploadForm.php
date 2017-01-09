<?php

namespace backend\models;

use yii\base\Model;

class UploadForm extends Model {

    public $id;
    public $imageFile;
    public $url;
    public $name;

    public function rules() {
        return [
            [['id'], 'integer'],
            [['url', 'name'], 'string'],
            [['imageFile'], 'file'],
        ];
    }

}
