<?php

namespace common\models\business;

use common\models\db\Category;
use common\models\db\Image;
use common\models\db\Item;
use common\models\enu\ImageType;
use common\models\output\QPage;
use common\models\output\Response;
use yii\db\Query;

class ItemBusiness
{

    /**
     * Chi tiết new
     * @param type $id
     */
    public static function get($id)
    {
        return Item::findOne($id);
    }

    /**
     * Thay đổi trạng thái item
     * @param type $id
     * @return type
     */
    public static function changeActive($id)
    {
        $item = Item::findOne($id);
        if ($item == null) {
            return new Response(false, "Sản phẩm không tồn tại");
        }
        $item->active = $item->active == 1 ? 0 : 1;
        $item->save();
        return new Response(true, "Sản phẩm " . $item->name . $item->active ? "has been active" : "has been locked", $item);
    }

    /**
     * Thay đổi trạng thái item
     * @param type $id
     * @return type
     */
    public static function saveDetail($id, $detail)
    {
        $item = Item::findOne($id);
        if ($item == null) {
            return new Response(false, "Sản phẩm có mã " . $id . " không tồn tại trên hệ thống!");
        }
        $item->details = $detail;
        $item->save();
        return new Response(true, "Lưu chi tiết sản phẩm thành công!", $item);
    }

    /**
     * Xóa sp hiện hành
     * @param type $id
     */
    public static function remove($id)
    {
        $item = self::get($id);
        if ($item == null) {
            return new Response(false, "Không thể thực hiện xóa một sản phẩm không tồn tại , vui lòng thử lại xin cảm ơn");
        }
        if (!empty($item)) {
            $images = Image::getByTarget([$id], ImageType::ITEM);
            if (!empty($images)) {
                $ids = [];
                foreach ($images as $img) {
                    $ids[] = $img->imageId;
                }
                Image::deleteByImageId($ids);
            }
        }
        Item::deleteAll(['id' => $id]);
        return new Response(true, "Xóa sản phẩm thành công!");
    }

    /**
     * @param null $keyword
     * @param null $ids
     * @param int $page
     * @param int $pageSize
     * @param string $order
     * @return QPage
     */
    static function getByCategoryIds($keyword = null, $ids = null, $page = 1, $pageSize = 20, $order = 'DESC', $size1 = [], $color1 = [],$prototype = [], $special = false, $suggest = false, $bestSelling = false)
    {
        if (is_array($size1) && !empty($size1)) {
            foreach ($size1 as $k => $s) {
                if ($s == '') {
                    unset($size1[$k]);
                }
            }
        }
        if (is_array($color1) && !empty($color1)) {
            foreach ($color1 as $k => $c) {
                if ($c == '') {
                    unset($color1[$k]);
                }
            }
        }
        if (is_array($prototype) && !empty($prototype)) {
            foreach ($prototype as $k => $c) {
                if ($c == '') {
                    unset($prototype[$k]);
                }
            }
        }
        $search = Item::find()->where(['active' => 1]);
        if ($keyword != null) {
            if ($keyword != null) {
                $search->andWhere("`name` LIKE :key OR `id` LIKE :key");
                $search->addParams(['key' => '%' . $keyword . '%']);
            }
        }

        if (!empty($ids)) {
            $search->andWhere(['categoryId' => $ids]);
        }
        if (!empty($color1)) {
            $search->andWhere(['color' => $color1]);
        }

        if (!empty($prototype)) {
            $search->andWhere(['prototype' => $prototype]);
        }

        if (!empty($size1)) {
            $search->andWhere(['size' => $size1]);
        }

        if ($special == true) {
            $search->andWhere(['special' => 1]);
        }

        if ($bestSelling == true) {
            $search->andWhere(['bestSelling' => 1]);
        }

        if ($suggest == true) {
            $search->andWhere(['suggest' => 1]);
        }


        $color = clone $search;
        $size = clone $search;
        $prototype = clone $search;

        $color = $color->select('`color`, COUNT(0) as count')->groupBy('color')->asArray(true)->all();
        $size = $size->select('`size`, COUNT(0) as count')->groupBy('size')->asArray(true)->all();
        $prototype = $prototype->select('`prototype`, COUNT(0) as count')->groupBy('prototype')->asArray(true)->all();

        if ($special == true || $bestSelling == true || $suggest == true) {
            $search->orderBy('`position` ASC');
        } else {
            $order = ($order == 'ASC') ? 'ASC' : 'DESC';
            $search->orderBy('createTime ' . $order);
        }
        $pros = [];
        foreach ($prototype as $pro){
            $pros[$pro['prototype']] = $pro['count'];
        }

        $result = new QPage();
        $result->other = [
            'colors' => $color,
            'sizes' => $size,
            'prototype' => $pros,
        ];
        $count = $search->count('0');
        $search->offset($page * $pageSize - $pageSize);
        $search->limit($pageSize);

        $result->itemCount = $count;
        $result->pageSize = $pageSize;
        $result->pageCount = ceil($count / $pageSize);
        $result->page = $page;

        $data = $search->all();
        foreach ($data as $d) {
            $result->ids[] = $d->id;
        }
        $result->data = $data;

        return $result;
    }

    static function getImagesByItemId($id)
    {
        return Image::find()->where(['targetId' => $id, 'type' => ImageType::ITEM])->all();
    }

    static function getImageByIds($ids, $detail = false)
    {
        if($detail){
            return Image::find()->where(['targetId' => $ids,'type' => ImageType::ITEM])->all();
        }
        $rs = [];
        $ids = is_array($ids) ? $ids : [$ids];
        foreach ($ids as $id) {
            $img = Image::find()->where(['targetId' => $id,'type' => ImageType::ITEM])->orderBy('id ASC')->one();
            if (!empty($img)) {
                $rs[$img->targetId] = $img;
            }
        }
        return $rs;
    }
}
