<?php

namespace frontend\controllers;

use common\models\business\CategoryBusiness;
use common\models\business\NewsBusiness;
use common\models\enu\NewsType;
use yii\web\Controller;

class BaseController extends Controller {

    public $staticClient;
    public $baseUrl;
    public $title_extend;
    public $title;
    public $description;
    public $keywrod;
    public $og;
    public $canonical;
    public $var = [];

    public function init() {
        parent::init();
        $this->baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . str_replace("index.php", '', $_SERVER['SCRIPT_NAME']);
        $this->title_extend = null;
        $this->mDefault();
        $this->menu();
    }

    /**
     * config default
     */
    private function mDefault() {
        $this->title = "Titan Architecture";
        $this->keywrod = "Titan Architecture";
        $this->description = "Titan Architecture";
        /**
         * config default og
         */
        $this->og = [
            "title" => "Titan Architecture",
            "site_name" => "titantoancau.com",
            "url" => $this->baseUrl,
            "image" => "",
            "description" => $this->description,
        ];
        $this->canonical = $this->baseUrl;
    }

    /**
     * Config meta
     * @param type $title
     * @param type $description
     * @param type $url
     * @param type $image
     * @param type $keywrod
     */
    protected function meta($title = null, $description = null, $url = null, $image = null, $keywrod = null) {
        if ($title != null) {
            $this->title = $title . $this->title_extend;
            $this->og['title'] = $title;
        }
        if ($description != null) {
            $this->description = $description;
            $this->og['description'] = $this->description;
        }
        if ($keywrod != null) {
            $this->keywrod = $keywrod;
        }
        if ($url != null) {
            $this->canonical = $url;
            $this->og['url'] = $this->canonical;
        }
        if ($image != null) {
            $this->og['image'] = $image;
        }
    }

    private function menu() {
        $category = CategoryBusiness::getAll(1);
        $newCustomerCare = NewsBusiness::getByType(NewsType::CUSTOMER_CARE);
        $this->var["category"] = $category;
        $this->var["newCustomerCare"] = $newCustomerCare;
    }

}
