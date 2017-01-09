<?php

/**
 * Created by PhpStorm.
 * User: quan
 * Date: 4/25/16
 * Time: 10:59 PM
 */

namespace frontend\controllers;

use common\models\business\NewsBusiness;
use common\models\db\Image;
use common\models\enu\ImageType;
use common\models\enu\NewsType;
use Yii;

class NewsController extends BaseController {

    function actionBrowse() {
        $page = Yii::$app->request->get('page', 1);
        $size = Yii::$app->request->get('size', 10);

        $news = NewsBusiness::getByTypeWithPage(NewsType::NEWS, $page, $size);
        $ids = [];
        foreach ($news->data as $new) {
            $ids[] = $new->id;
        }
        $images = Image::getByTarget($ids, ImageType::NEWS, false, true);
        foreach ($news->data as $new) {
            $imgs = [];
            foreach ($images as $img) {
                if ($new->id == $img->targetId) {
                    $imgs[] = $img->imageId;
                }
            }
            $new->images = $imgs;
        }
        return $this->render('browse', [
                    "news" => $news,
        ]);
    }

    function actionDetail() {
        $id = Yii::$app->request->get('id');
        $new = NewsBusiness::get($id);
        return $this->render('detail', [
                    "new" => $new,
        ]);
    }

}
