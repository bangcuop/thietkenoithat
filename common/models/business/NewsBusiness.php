<?php

namespace common\models\business;

use common\models\db\Image;
use common\models\db\News;
use common\models\enu\ImageType;
use common\models\enu\NewsType;
use common\models\output\QPage;
use common\models\output\Response;

class NewsBusiness {

    /**
     * Chi tiết new
     * @param type $id
     */
    public static function get($id) {
        return News::findOne($id);
    }

    /**
     * Xóa news hiện hành
     * @param type $id
     */
    public static function remove($id) {
        $news = self::get($id);
        if ($news == null) {
            return new Response(false, "Không thể thực hiện xóa một tin tức không tồn tại , vui lòng thử lại xin cảm ơn");
        }
        if (!empty($news)) {
            $images = Image::getByTarget([$id], ImageType::NEWS);
            if (!empty($images)) {
                $ids = [];
                foreach ($images as $img) {
                    $ids[] = $img->imageId;
                }
                Image::deleteByImageId($ids);
            }
        }
        News::deleteAll(['id' => $id]);
        return new Response(true, "Xóa tin tức thành công");
    }

    /**
     * Thay đổi trạng thái news
     * @param type $id
     * @return type
     */
    public static function changeActive($id) {
        $new = News::findOne($id);
        if ($new == null) {
            return new Response(false, "Tin tức không tồn tại");
        }
        $new->active = $new->active == 1 ? 0 : 1;
        $new->save();
        return new Response(true, "News " . $new->name . $new->active ? "has been active" : "has been locked", $new);
    }

    /**
     * Lấy ra tất cả các bản ghi news hiện hành
     * @return type
     */
    public static function getAll($limit = '') {
        $news = News::find();
        if ($limit != '' || $limit != null) {
            $news->limit($limit);
        }
        return $news->all();
    }

    /**
     * Get By Alias
     * @return type
     */
    public static function getByAlias($alias) {
        return News::findOne(["alias" => $alias]);
    }

    /**
     * 
     * @param type $type
     * @return type
     */
    public static function getByTypeWithPage($type, $page = 1, $pageSize = 20, $order = 'DESC') {
        $search = News::find()->where(['type' => $type]);
        $count = $search->count('0');
        $result = new QPage();
        $search->offset($page * $pageSize - $pageSize);
        $search->limit($pageSize);
        $search->orderBy('createTime ' . $order);

        $result->itemCount = $count;
        $result->pageSize = $pageSize;
        $result->pageCount = ceil($count / $pageSize);
        $result->page = $page;

        $data = $search->all();
        $result->data = $data;
        return $result;
    }

    /**
     * 
     * @param type $type
     * @return type
     */
    public static function getByType($type) {
        return News::findAll(['type' => $type]);
    }

    /**
     * 
     * @return type
     */
    public static function getNewsAbout() {
        return News::findOne(["type" => NewsType::ABOUT]);
    }

}
