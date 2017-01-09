<?php

namespace common\models\input;

use common\models\db\Image;
use common\models\db\Item;
use common\models\enu\ImageType;
use common\models\enu\ItemType;
use common\models\output\DataPage;
use yii\base\Model;
use yii\data\Pagination;

class ItemSearch extends Model {

    public $id;
    public $name;
    public $active;
    public $createEmail;
    public $updateEmail;
    public $createTimeFrom;
    public $updateTimeFrom;
    public $createTimeTo;
    public $updateTimeTo;
    public $type;
    public $prototype;
    public $special;
    public $bestSelling;
    public $suggest;
    public $priceFrom;
    public $priceTo;
    public $sort;
    public $page;
    public $pageSize;
    public $w_thum = 0;
    public $h_thum = 0;

    public function rules() {
        return [
            [['id', 'sort', 'name', 'createEmail', 'updateEmail', 'prototype'], 'string'],
            [['createTimeFrom', 'createTimeTo', 'updateTimeFrom', 'updateTimeTo', 'active', 'type', 'special', 'bestSelling', 'suggest'], 'integer'],
            [['priceFrom', 'priceTo'], 'double'],
        ];
    }

    /**
     * search
     * @param type $page
     * @return DataPage
     */
    public function search($page) {
        $query = Item::find();
        $dataPage = new DataPage();
        if ($this->name != null && $this->name != '') {
            $query->andWhere(['like', 'name', $this->name]);
        }
        if ($this->id != null && $this->id != '') {
            $query->andWhere(['=', 'id', $this->id]);
        }
        if ($this->active > 0) {
            $query->andWhere(['=', 'active', $this->active == 1 ? 1 : 0]);
        }
        if ($this->type > 0) {
            if ($this->type == 1) {
                $query->andWhere(['=', 'special', 1]);
            }
            if ($this->type == 2) {
                $query->andWhere(['=', 'bestSelling', 1]);
            }
            if ($this->type == 3) {
                $query->andWhere(['=', 'suggest', 1]);
            }
            if ($this->type == 4) {
                $query->andWhere(['=', 'suggest', 0]);
                $query->andWhere(['=', 'bestSelling', 0]);
                $query->andWhere(['=', 'special', 0]);
            }
        }
        if ($this->prototype > 0) {
            if ($this->prototype == 1) {
                $query->andWhere(['=', 'prototype', ItemType::CLASSIC]);
            }
            if ($this->prototype == 2) {
                $query->andWhere(['=', 'prototype', ItemType::MODERN]);
            }
            if ($this->prototype == 3) {
                $query->andWhere(['=', 'prototype', ItemType::CRAFTS]);
            }
        }
        if ($this->createEmail != null && $this->createEmail != '') {
            $query->andWhere(['like', 'createEmail', $this->createEmail]);
        }
        if ($this->updateEmail != null && $this->updateEmail != '') {
            $query->andWhere(['like', 'updateEmail', $this->updateEmail]);
        }
        if ($this->priceFrom > 0 && $this->priceTo > 0) {
            $query->andWhere(['between', 'sellPrice', $this->priceFrom, $this->priceTo]);
        } else if ($this->priceFrom > 0) {
            $query->andWhere('sellPrice >= :price', [':price' => $this->priceFrom]);
        } else if ($this->priceTo > 0) {
            $query->andWhere('sellPrice <= :price', [':price' => $this->priceTo]);
        }
        if ($this->createTimeFrom > 0 && $this->createTimeTo > 0) {
            $query->andWhere(['between', 'createTime', $this->createTimeFrom / 1000, $this->createTimeTo / 1000]);
        } else if ($this->createTimeFrom > 0) {
            $query->andWhere('createTime >= :time', [':time' => $this->createTimeFrom / 1000]);
        } else if ($this->createTimeTo > 0) {
            $query->andWhere('createTime <= :time', [':time' => $this->createTimeTo / 1000]);
        }

        if ($this->updateTimeFrom > 0 && $this->updateTimeTo > 0) {
            $query->andWhere(['between', 'updateTime', $this->updateTimeFrom / 1000, $this->updateTimeTo / 1000]);
        } else if ($this->updateTimeFrom > 0) {
            $query->andWhere('endTime >= :time', [':time' => $this->updateTimeFrom / 1000]);
        } else if ($this->updateTimeTo > 0) {
            $query->andWhere('endTime <= :time', [':time' => $this->updateTimeTo / 1000]);
        }
        switch ($this->sort) {
            case 'createTime_asc':
                $query->orderBy("createTime ASC");
                break;
            case 'updateTime_asc':
                $query->orderBy("updateTime ASC");
                break;
            case 'updateTime_desc':
                $query->orderBy("updateTime DESC");
                break;
            case 'active_asc':
                $query->orderBy("active ASC");
                break;
            case 'active_desc':
                $query->orderBy("active DESC");
                break;
            default :
                $query->orderBy("updateTime DESC");
        }
        if (!$page) {
            return $query;
        }
        $dataPage->dataCount = $query->count();
        $dataPage->dataCount = $dataPage->dataCount == null ? 0 : $dataPage->dataCount;
        $dataPage->pageSize = $this->pageSize <= 0 ? 100 : $this->pageSize;
        $dataPage->page = $this->page <= 0 ? 1 : $this->page;
        $paging = new Pagination(['totalCount' => $dataPage->dataCount]);
        $paging->setPageSize($dataPage->pageSize);
        $paging->setPage($dataPage->page - 1);
        $query->limit($paging->getLimit());
        $query->offset($paging->getOffset());
        $dataPage->data = $query->all();
        $dataPage->pageCount = $dataPage->dataCount / $dataPage->pageSize;
        if ($dataPage->pageCount % $dataPage->pageSize != 0) {
            $dataPage->pageCount = ceil($dataPage->pageCount) + 1;
        }
        $dataPage->pageCount = $dataPage->pageCount < 1 ? 1 : $dataPage->pageCount - 1;
        $ids = [];
        foreach ($dataPage->data as $item) {
            $ids[] = $item->id;
        }
        $images = Image::getByTarget($ids, ImageType::ITEM, false, true);
        foreach ($dataPage->data as $item) {
            $imgs = [];
            foreach ($images as $img) {
                if ($item->id == $img->targetId) {
                    $imgs[] = $img->imageId;
                }
            }
            $item->images = $imgs;
        }
        return $dataPage;
    }

}
