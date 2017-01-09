<?php
/**
 * Created by PhpStorm.
 * User: quan
 * Date: 4/25/16
 * Time: 10:59 PM
 */

namespace frontend\controllers;

use common\models\business\CategoryBusiness;
use common\models\business\ItemBusiness;
use Yii;

class ProductController extends BaseController
{
    function actionCategory()
    {
        $catId = Yii::$app->request->get('id', 0);
        $keyword = Yii::$app->request->get('keyword');
        $page = Yii::$app->request->get('page', 1);
        $size = Yii::$app->request->get('size', 20);
        $order = Yii::$app->request->get('order', 'DESC');

        $catInfor = CategoryBusiness::get($catId);
        $subCat = CategoryBusiness::getByParentId(0);
        $subResult = [];
        $subCateSec = [];
        $ids = [];
        foreach ($subCat as $sCat) {
            $ids[] = $sCat->id;
        }
        if (!empty($ids)) {
            $subCateSec = CategoryBusiness::getByParentId($ids, 1);
        }
        foreach ($subCateSec as $subCatTmp) {
            $subResult[$subCatTmp->parentId][] = $subCatTmp;
        }
        $items = ItemBusiness::getByCategoryIds($keyword, CategoryBusiness::getIds($catId), $page, $size, $order, Yii::$app->request->get('sizes'), Yii::$app->request->get('colors'),Yii::$app->request->get('prototype'));

        $images = ItemBusiness::getImageByIds($items->ids);

        return $this->render('category', [
            'sub' => $subCat,
            'sub2' => $subResult,
            'items' => $items,
            'images' => $images,
        ]);
    }

    function actionDetail()
    {
        $item = ItemBusiness::get(Yii::$app->request->get('id'));
        $images = ItemBusiness::getImageByIds(Yii::$app->request->get('id'), true);
        return $this->render('detail', [
            'item' => $item,
            'images' => $images,
        ]);
    }
}