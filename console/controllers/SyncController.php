<?php

namespace console\controllers;

use common\models\business\BrandBusiness;
use common\models\business\CategoryBusiness;
use common\models\business\ImageBusiness;
use common\models\db\Brand;
use common\models\db\Category;
use common\models\db\Seller;
use common\models\enu\ImageType;
use common\models\store\StoreItem;
use common\util\StoreClient;
use common\util\TextUtils;
use Exception;

class SyncController extends ConsoleController {

    public function actionSeller() {
        $resp = $this->get("http://dailyvita.vn/test/getallseller.json");
        foreach ($resp->data as $s) {
            $seller = Seller::findOne($s->id);
            if ($seller == null) {
                $seller = new Seller();
                $seller->id = $s->id;
                $seller->createTime = time();
                $seller->createEmail = "bapcai.vn29@gmail.com";
            }
            $seller->active = $s->active;
            $seller->parentId = 'dailyvita.vn';
            $seller->name = $s->name;
            $seller->website = $s->website;
            $seller->usTax = $s->usTax == null ? 0 : $s->usTax;
            $seller->feeShip = $s->feeShip == null ? 0 : $s->feeShip;
            $seller->feeMore = $s->feeMore == null ? 0 : $s->feeMore;
            $seller->updateTime = time();
            $seller->updateEmail = "bapcai.vn29@gmail.com";
            $seller->save();
        }
    }

    public function actionBrand() {
        $resp = $this->get("http://dailyvita.vn/test/getallmanu.json");
        foreach ($resp->data as $s) {
            //$s->name = str_replace('®', '', $s->name);
            $id = TextUtils::removeMarks($s->name);
            echo $id = preg_replace('/\W/', '', $id);
            //echo $s->name = preg_replace('/(^[a-zA-Z0-9])/', '', strtolower($s->name));
            print_r("\n");
            //if(1==1) {
            //continue;
            //}
            //die();
            $brand = BrandBusiness::get($id);
            if ($brand == null) {
                $brand = new Brand();
                $brand->id = $id;
            }
            $brand->position = 1;
            $brand->name = $s->name;
            $brand->active = $s->active == true ? 1 : 0;
            $brand->description = $s->description;
            $brand->save();

            if ($s->image != null) {
                try {
                    ImageBusiness::dowload('http://dailyvita.vn' . $s->image, ImageType::BRAND, $brand->id);
                } catch (Exception $e) {
                    
                }
            }
            print_r("\n, ---> " . $brand->id);
        }
    }

    public function actionCategory() {
        $resp = $this->get("http://dailyvita.vn/test/getallcat.json");
        foreach ($resp->data as $c) {
            $category = Category::findOne(substr($c->id, -6));
            if ($category == null) {
                $category = new Category();
                $category->id = substr($c->id, -6);
                $category->createEmail = "bapcai.vn29@gmail.com";
                $category->createTime = time();
            }
            $category->updateTime = time();
            $category->updateEmail = "bapcai.vn29@gmail.com";
            $category->parentId = empty($c->parentId) ? '0' : substr($c->parentId, -6);
            $category->active = $c->active == true ? 1 : 0;
            $category->leaf = $c->leaf == true ? 1 : 0;
            $category->level = $c->level;
            $category->position = empty($c->order) ? 1 : $c->order;
            $category->description = $c->description;
            $category->name = $c->name;
            $category->alias = TextUtils::removeMarks($c->name);
            $cats = CategoryBusiness::getCategoryPath($category->id);
            $cats = empty($cats) ? [] : $cats;
            $path = [];
            foreach ($cats as $cPath) {
                if (!empty($cPath))
                    $path[] = $cPath->id;
            }
            $category->path = json_encode($path);
            $cate = Category::findOne(["alias" => $category->alias]);
            if ($cate != null && $cate->id != $category->id) {
                $category->alias = $category->alias . "-" . $category->id;
            }
            $category->save();
//            if ($c->image != null && TextUtils::exists('http://naima.vn/upload' . $c->image)) {
//                try {
//                    ImageBusiness::dowload('http://naima.vn/upload' . $c->image, ImageType::CATEGORY_LOGO, $category->id);
//                } catch (Exception $exc) {
//                    
//                }
//            }
//            if ($c->indexImage != null && TextUtils::exists('http://naima.vn/upload' . $c->indexImage)) {
//                try {
//                    ImageBusiness::dowload('http://naima.vn/upload' . $c->indexImage, ImageType::CATEGORY_HOME, $category->id);
//                } catch (Exception $exc) {
//                    
//                }
//            }
            print_r("--add category " . $category->id . " : " . json_encode($category->errors) . "\n");
//            die();
        }
    }

    public function actionItem() {
        $i = 1;
        while (true) {
            if ($i > 120) {
                break;
            }
            $i++;
            $resp = $this->get("http://dailyvita.vn/test/getallitem.json?page=" . $i);
            $is = [];
            foreach ($resp->data->data as $item) {
                $storeItem = new StoreItem();
                $storeItem->update = ['specifics', 'startTime', 'endTime', 'quantity', 'startPrice', 'weight', 'sellPrice', 'detail'];
                $storeItem->parentId = 0;
                $storeItem->condition = 2;
                $storeItem->listingType = 2;
                $storeItem->source = 'dailyvita';
                $storeItem->external = 0;
                $storeItem->sourceSku = $item->sourceUrl;
                $storeItem->name = $item->nameEn;
                $storeItem->lang = 'en';
                $storeItem->detail = $item->detail;
                if (empty(!$item->name)) {
                    $storeItem->name = $item->name;
                    $storeItem->lang = 'vn';
                }
                $storeItem->weight = empty($item->weight) ? 150 : intval($item->weight);
                $storeItem->quantity = $item->quantity == null || $item->quantity == "" ? 0 : $item->quantity;
                $storeItem->soldQuantity = $item->soldQuantity;
                $storeItem->startPrice = $item->startPrice == null || $item->startPrice == "" ? 0 : $item->startPrice;
                $storeItem->sellPrice = $item->sellPrice == null || $item->sellPrice == "" ? 0 : $item->sellPrice;
                $storeItem->startTime = time();
                $storeItem->endTime = time();
                $storeItem->active = 1;
                $storeItem->images = !empty($item->imageIds) ? $item->imageIds : [];
                $storeItem->specifics = [];
                //add category
                $item->manufacturerName = str_replace('®', '', $item->manufacturerName);
                $item->manufacturerName = TextUtils::removeMarks($item->manufacturerName);
                $brand = BrandBusiness::get($item->manufacturerName);
                $storeItem->specifics[] = [
                    "name" => "seller",
                    "value" => [strval($item->sellerId != null && $item->sellerId != '' ? $item->sellerId : "dailyvita.vn")]
                ];
                if ($brand != null) {
                    $storeItem->specifics[] = [
                        "name" => "brand",
                        "value" => [strval($brand->id)]
                    ];
                    $storeItem->specifics[] = [
                        "name" => "brand_name",
                        "value" => [strval($brand->name)]
                    ];
                }
                $cate = CategoryBusiness::getByName($item->categoryName);
                if ($cate != null) {
                    $storeItem->specifics[] = [
                        "name" => "category",
                        "value" => [strval($cate->id)]
                    ];
                    $storeItem->specifics[] = [
                        "name" => "category_name",
                        "value" => [strval($cate->name)]
                    ];
                    $storeItem->specifics[] = [
                        "name" => "category_path",
                        "value" => empty($cate->path) ? [] : array_map('strval', array_filter(json_decode($cate->path)))
                    ];
                }
                $is[] = $storeItem;
                print_r("\n\t---> " . $storeItem->name);
            }
			print_r(StoreClient::pushItem($is));
			//die();
        }
    }

}
