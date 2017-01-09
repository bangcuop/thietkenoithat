<?php

namespace frontend\controllers;

use common\models\business\BannerBusiness;
use common\models\business\ItemBusiness;
use common\models\enu\BannerType;

class IndexController extends BaseController
{

    /**
     *
     * @return type
     */
    public function actionIndex()
    {
        $bannerHeart = BannerBusiness::getByType(BannerType::HEART, 1);
        $bannerCenter = BannerBusiness::getByType(BannerType::CENTER, 1);


        $spe = ItemBusiness::getByCategoryIds(null, [], 1, 6, 'DESC', [], [],[], true, false, false);
        $sug = ItemBusiness::getByCategoryIds(null, [], 1, 6, 'DESC', [], [],[], false, true, false);
        $best = ItemBusiness::getByCategoryIds(null, [], 1, 6, 'DESC', [], [],[], false, false, true);

        $images = ItemBusiness::getImageByIds(array_merge($spe->ids, $sug->ids, $best->ids));

//        print_r($bannerHeart);die;
        return $this->render('index', [
            "bannerHeart" => $bannerHeart,
            "bannerCenter" => $bannerCenter,
            "spe" => $spe,
            "sug" => $sug,
            "best" => $best,
            "images" => $images,
        ]);
    }

}
