<?php

namespace backend\models;

use common\models\business\ItemBusiness;
use common\models\output\Response;
use common\models\db\Item;
use Yii;
use yii\base\Model;

class ItemForm extends Model {

    public $id;
    public $name;
    public $categoryId;
    public $createTime;
    public $updateTime;
    public $sellPrice;
    public $description;
    public $details;
    public $viewCount;
    public $active;
    public $special;
    public $bestSelling;
    public $suggest;
    public $position;
    public $quantity;
    public $color;
    public $size;
    public $prototype;

    public function rules() {
        return [
            [['id', 'name', 'description', 'categoryId'], 'required', 'message' => '{attribute} không được để trống'],
            [['categoryId', 'createTime', 'updateTime', 'viewCount', 'active', 'special', 'bestSelling', 'suggest', 'position', 'quantity'], 'integer'],
            [['sellPrice'], 'number', 'message' => '{attribute} phải là số'],
            [['description', 'details', 'color', 'size'], 'string'],
            [['id', 'prototype'], 'string', 'max' => 32],
            [['name', 'color', 'size'], 'string', 'max' => 500],
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'Tên sản phẩm',
            'id' => 'Mã sản phẩm',
            'detail' => 'Chi tiết sản phẩm',
            'description' => 'Mô tả sản phẩm',
            'categoryId' => 'Danh mục sản phẩm',
            'sellPrice' => 'Giá sản phẩm',
        ];
    }

    /**
     * 
     * @return Response
     */
    public function save() {
        if (!$this->validate()) {
            return new Response(false, "Dữ liệu không chính xác vui lòng nhập lại", $this->errors);
        }

        $item = new Item();
        if ($this->id == null || empty($this->id)) {
            return new Response(false, "Mã sản phẩm không được để trống!");
        }
        if (!empty(ItemBusiness::get($this->id))) {
            return new Response(false, "Mã sản phẩm này đã tồn tại,vui lòng nhập mã khác!");
        }
        $item->id = $this->id;
        $item->createTime = time();
        $item->createEmail = Yii::$app->user->getId();
        $item->viewCount = 0;
        $item->name = $this->name;
        $item->updateTime = time();
        $item->updateEmail = Yii::$app->user->getId();
        $item->categoryId = $this->categoryId;
        $item->description = $this->description;
        $item->active = $this->active == 1 ? 1 : 0;
        $item->sellPrice = ($this->sellPrice != null && $this->sellPrice != '' && $this->sellPrice > 0) ? $this->sellPrice : 0;
        $item->special = $this->special == 1 ? 1 : 0;
        $item->bestSelling = $this->bestSelling == 1 ? 1 : 0;
        $item->suggest = $this->suggest == 1 ? 1 : 0;
        $item->position = $this->special == 1 ? $this->position : 0;
        $item->quantity = $this->quantity;
        $item->prototype = $this->prototype;
        $item->color = ($this->color != null && $this->color != '') ? $this->color : 'Khác';
        $item->size = ($this->size != null && $this->size != '') ? $this->size : 'Khác';
        if (!$item->save()) {
            return new Response(false, "Dữ liệu truyền vào không chính xác vui lòng nhập lại", $item->errors);
        }
        return new Response(true, "Thêm sản phẩm thành công!", $item);
    }

    public function edit() {
        if (!$this->validate()) {
            return new Response(false, "Dữ liệu không chính xác vui lòng nhập lại", $this->errors);
        }

        if ($this->id == null || empty($this->id)) {
            return new Response(false, "Không tìm thấy mã sản phẩm!");
        }
        $item = ItemBusiness::get($this->id);
        if (empty($item)) {
            return new Response(false, "Sản phẩm không tồn tại trên hệ thống!");
        }
        $item->name = $this->name;
        $item->updateTime = time();
        $item->updateEmail = Yii::$app->user->getId();
        $item->categoryId = $this->categoryId;
        $item->description = $this->description;
        $item->active = $this->active == 1 ? 1 : 0;
        $item->sellPrice = ($this->sellPrice != null && $this->sellPrice != '' && $this->sellPrice > 0) ? $this->sellPrice : 0;
        $item->special = $this->special == 1 ? 1 : 0;
        $item->bestSelling = $this->bestSelling == 1 ? 1 : 0;
        $item->suggest = $this->suggest == 1 ? 1 : 0;
        $item->position = $this->special == 1 ? $this->position : 0;
        $item->quantity = $this->quantity;
        $item->prototype = $this->prototype;
        $item->color = ($this->color != null && $this->color != '') ? $this->color : 'Khác';
        $item->size = ($this->size != null && $this->size != '') ? $this->size : 'Khác';
        if (!$item->save()) {
            return new Response(false, "Dữ liệu truyền vào không chính xác vui lòng nhập lại", $item->errors);
        }
        return new Response(true, "Sửa thông tin sản phẩm thành công!", $item);
    }

}
