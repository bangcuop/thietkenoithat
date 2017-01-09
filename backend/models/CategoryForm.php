<?php

namespace backend\models;

use common\models\business\CategoryBusiness;
use common\models\db\Category;
use common\models\output\Response;
use common\util\TextUtils;
use yii\base\Model;

class CategoryForm extends Model {

    public $id;
    public $name;
    public $parentId;
    public $level;
    public $description;
    public $position;
    public $leaf;
    public $active;
    public $updateTime;
    public $createTime;

    public function rules() {
        return [
            [['name', 'description'], 'string'],
            [['name', 'description'], 'required', 'message' => '{attribute}'],
            [['id', 'parentId', 'level', 'position', 'leaf', 'active', 'updateTime', 'createTime'], 'integer'],
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'Tên danh mục không được để trống',
            'description' => 'Mô tả không được để trống',
        ];
    }

    /**
     * Thêm mới danh mục
     */
    public function Add() {
        if (!$this->validate()) {
            return new Response(false, "Thông tin nhập vào chưa chính xác!", $this->errors);
        }
        $category = new Category();
        $category->name = $this->name;
        $category->description = $this->description;
        $category->createTime = time();
        $category->updateTime = time();
        $category->position = $this->position;
        $category->active = $this->active == 1 ? 1 : 0;
        $category->parentId = $this->parentId;
        if ($this->parentId != 0) {
            $parent = CategoryBusiness::get($this->parentId);
            if ($parent == null) {
                return new Response(false, "Danh mục cha không tồn tại!", ["parentId" => "Danh mục cha không tồn tại trên hệ thống"]);
            } else {
                $category->parentId = $parent->id;
                $category->level = $parent->level + 1;
                $parent->leaf = 0;
                $parent->save(false);
            }
        } else {
            $category->level = 1;
        }
        $category->leaf = 1;
        if (!$category->validate() || !$category->save()) {
            return new Response(false, 'Có lỗi,dữ liệu không chính xác', $category->errors);
        }
        $obj = CategoryBusiness::getCategoryPath($category->id);
        $path = [];
        foreach ($obj as $cat) {
            $path[] = $cat->id;
        }
        $category->path = json_encode($path);
        $category->save(false);
        return new Response(true, "Thêm mới danh mục thành công!", $category);
    }

    /**
     * Sửa danh mục
     * @return Response
     */
    public function edit() {
        if (!$this->validate()) {
            return new Response(false, "Thông tin nhập vào chưa chính xác!", $this->errors);
        }
        $category = CategoryBusiness::get($this->id);
        if ($category == null) {
            return new Response(false, "Danh mục không tồn tại trên hệ thống!");
        } else {
            $category->name = $this->name;
            $category->active = $this->active == 1 ? 1 : 0;
            $category->position = $this->position;
            $category->description = $this->description;
            $category->updateTime = time();
            $category->parentId = $this->parentId;
            $oldCategory = CategoryBusiness::get($category->id);
            if ($oldCategory->parentId == 0 ? $category->parentId != 0 : $oldCategory->parentId != $category->parentId) {
                if ($this->parentId != 0) {
                    $catParent = CategoryBusiness::get($category->parentId);
                    if ($catParent == null) {
                        return new Response(false, "Danh mục cha không tồn tại!", ["parentId" => "Danh mục cha không tồn tại trên hệ thống"]);
                    } else {
                        if ($catParent->id == $category->id) {
                            return new Response(false, "Chuyển danh mục cha thất bại!", ["parentId" => "Danh mục cha không được là chính nó,hãy chọn danh mục khác!"]);
                        }
                        $listCatChild = CategoryBusiness::getAllCatChild($category->id);
                        if ($listCatChild != null) {
                            return new Response(false, "Chuyển danh mục cha thất bại", ["parentId" => "Danh mục này đang có danh mục con,không thể chuyển danh mục cha!"]);
                        }
                        $catParent->leaf = 0;
                        $catParent->save(false);
                        $category->level = $catParent->level + 1;
                    }
                } else {
                    $category->level = 1;
                }
            }
            $active = $category->active;
            $listCatChild = CategoryBusiness::getAllCatChild($category->id);
            foreach ($listCatChild as $cat) {
                $cat->active = $active;
                $cat->save(false);
            }
            if (!$category->validate() || !$category->save()) {
                return new Response(false, 'Có lỗi,dữ liệu không chính xác', $category->errors);
            }
            $obj = CategoryBusiness::getCategoryPath($category->id);
            $path = [];
            foreach ($obj as $cat) {
                $path[] = $cat->id;
            }
            $category->path = json_encode($path);
            $category->save(false);
            return new Response(true, "Sửa danh mục thành công!", $category);
        }
    }

    /**
     * gen alais
     * @return type
     */
    private function genAlias() {
        $alias = $this->alias;
        if ($alias == null || $alias == "") {
            $alias = TextUtils::removeMarks($this->name);
        }
        return trim($alias);
    }

}
