<?php

namespace backend\models;

use common\models\business\NewsBusiness;
use common\models\db\News;
use common\models\enu\NewsType;
use common\models\output\Response;
use common\util\TextUtils;
use yii\base\Model;

class NewsForm extends Model {

    public $id;
    public $description;
    public $name;
    public $type;
    public $createTime;
    public $createEmail;
    public $updateTime;
    public $updateEmail;
    public $detail;
    public $active;

    public function rules() {
        return [
            [['name', 'detail','description'], 'required', 'message' => '{attribute} không được để trống'],
            [['createTime', 'updateTime', 'active', 'id', 'type'], 'integer'],
            [['detail','description'], 'string'],
            [['name', 'createEmail', 'updateEmail'], 'string', 'max' => 220]
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'Tên tin  tức',
            'detail' => 'Nội dung không được để trống',
        ];
    }

    public function save() {
        if (!$this->validate()) {
            return new Response(false, "Dữ liệu không chính xác vui lòng nhập lại", $this->errors);
        }

        $news = NewsBusiness::get($this->id);
        if ($news == null) {
            $news = new News();
            $news->createTime = time();
            $news->createEmail = $this->createEmail;
        }
        $news->name = $this->name;
        $news->description = $this->description;
        $news->updateTime = time();
        $news->updateEmail = $this->updateEmail;
        if ($this->type == 0) {
            $news->type = NewsType::NEWS;
        } else if ($this->type == 1) {
            $news->type = NewsType::ACTIVITY;
        } else if ($this->type == 2) {
            $news->type = NewsType::ABOUT;
        } else {
            $news->type = NewsType::CUSTOMER_CARE;
        }
        $news->detail = $this->detail;
        $news->active = $this->active == 1 ? 1 : 0;
        if (!$news->save()) {
            return new Response(false, "Dữ liệu truyền vào không chính xác vui lòng nhập lại", $news->errors);
        }

        return new Response(true, "Thao tác với bài tin -- " . $news->name . " --  thành công", $news);
    }


}
