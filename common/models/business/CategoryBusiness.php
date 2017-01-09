<?php

namespace common\models\business;

use common\models\db\Category;
use common\models\db\CategoryProperty;
use common\models\db\CategoryPropertyValue;
use common\models\output\Response;

class CategoryBusiness {

    /**
     * Chi tiết nhóm danh mục
     * @param type $id
     */
    public static function get($id) {
        return Category::findOne($id);
    }

    /**
     * Xóa nhóm danh mục
     * @param type $id
     */
    public static function remove($id) {
        $cate = self::get($id);
        if (Category::findAll(['parentId' => $cate->id]) != null) {
            return new Response(false, "Vui lòng xóa danh mục con trước ! ");
        }
        Category::deleteAll(['id' => $cate->id]);
        return new Response(true, "Xóa thành công");
    }

    /**
     * Thay đổi trạng thái hoạt động
     * @param type $id
     */
    public static function changeActive($id) {
        $category = Category::findOne($id);
        if ($category == null) {
            return new Response(false, "Danh mục không tồn tại");
        }

        $category->active = $category->active == 1 ? 0 : 1;

//        $cate = self::get($id);
//        $catesub = Category::findAll(['parentId' => $cate->id]);
//        if ($catesub != null) {
//            if ($category->active == 1) {
//                foreach ($catesub as $val) {
//                    $val->active = 1;
//                    $val->save(false);
//                }
//            } else {
//                foreach ($catesub as $val) {
//                    $val->active = 0;
//                    $val->save(false);
//                }
//            }
//        }

        $category->save();
        return new Response(true, "Danh mục " . $category->name . $category->active ? "đã mở khóa" : "đã khóa", $category);
    }

    /**
     * Lấy tất cả danh mục hiện hành
     * @return type
     */
    public static function getAll($active = 0) {
        $data = Category::find();
        if ($active != 0) {
            $data->andWhere(['active' => $active == 1 || $active == true ? 1 : 0]);
        }
        $data->orderBy("position asc");
        return $data->all();
    }

    /**
     * Thay đổi vị trí 
     * @return type
     */
    public static function changePosition($id, $postion) {
        $category = Category::findOne($id);
        if ($category == null) {
            return new Response(false, "Danh mục không tồn tại");
        }
        $category->position = $postion;
        $category->save();
        return new Response(true, "Thay đổi vị trí hiển thị thành công", $category);
    }

    /**
     * Get By Alias
     * @return type
     */
    public static function getByAlias($alias) {
        return Category::findOne(["alias" => $alias]);
    }

    /**
     * Kiểm tra alias
     * @param type $alias
     * @return type
     */
    public static function exitsAlias($alias) {
        return Category::find(["alias" => $alias])->count() != 0;
    }

    /**
     * Get all category child by id 
     * @param type $id
     * @return type
     */
    public static function getAllCatChild($id) {
        return Category::findAll(["parentId" => $id]);
    }

    /**
     * Get all category child by id 
     * @param type $id
     * @return type
     */
    public static function getByLeaf($leaf = 1, $time = 0) {
        $find = Category::find();
        $find->andWhere(["leaf" => $leaf]);
        if ($time > 0) {
            $find->andWhere("updateTime < :updateTime", [":updateTime" => $time]);
        }
        return $find->all();
    }

    /**
     * Get category by parentId
     * @param type $id
     * @return type
     */
    public static function getByParentId($parentId, $active = 0) {
        $query = Category::find();
        $query->andWhere(["parentId" => $parentId]);
        if ($active != 0) {
            $query->andWhere(["active" => $active == 1 ? 1 : 0]);
        }
        $query->orderBy("position asc");
        return $query->all();
    }

    /**
     * Get all category child by id 
     * @param type $id
     * @return type
     */
    public static function getCategoryPath($id, $path = []) {
        $category = self::get($id);
        $path[] = $category;
        if ($category == null || $category->parentId == null || $category->parentId == 0) {
            return array_reverse($path);
        }
        return self::getCategoryPath($category->parentId, $path);
    }

    /**
     * Get all category child by id 
     * @param type $id
     * @return type
     */
    public static function getCategory($id, $path = []) {
        $category = self::get($id);
        $path[] = $category;
        return self::getCategoryPath($category->parentId, $path);
    }
	
	/**
     * Get by name phục vụ đẩy sp từ dailyvita lên item_caching
     * @param type $name
     * @return type
     */
    public static function getByName($name) {
        return Category::findOne(["name" => $name]);
    }

    static function getIds($id, $current = [])
    {
        if ($id != 0 && empty($id)) {
            return array_unique($current);
        }
        $id = is_array($id) ? $id : [$id];
        $current = array_merge($current,$id);
        $child = Category::find()->where(['parentId' => $id])->all();
        $childIds = [];
        foreach ($child as $cat) {
            $childIds[] = $cat->id;
            $current[] = $cat->id;
        }
        return static::getIds($childIds, $current);
    }

}
