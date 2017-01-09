<?php

namespace common\models\input;

use common\models\business\ImageBusiness;
use common\models\db\Banner;
use common\models\db\Image;
use common\models\enu\ImageType;
use common\models\output\DataPage;
use yii\base\Model;
use yii\data\Pagination;


class BannerSearch extends Model {

    public $id;
    public $name;
    public $active;
    public $link;
    public $position;
    public $type;
    public $sort;
    public $page;
    public $pageSize;
  

    public function rules() {
        return [
            [['name', 'type'], 'required'],
            [['active', 'position', 'id', 'page', 'pageSize'], 'integer'],
            [['name', 'link'], 'string', 'max' => 220],
            [['type'], 'string', 'max' => 50],
            [['sort'], 'string'],
        ];
    }

    public function search($page = false) {
        $query = Banner::find();
        if ($this->active > 0) {
            $query->andWhere(['=', 'active', $this->active == 1 ? 1 : 0]);
        }
        if ($this->name != '' && $this->name != null) {
            $query->andWhere(['LIKE', 'name', strtolower($this->name)]);
        }
        if ($this->type != '' && $this->type != null) {
            $query->andWhere(['=', 'type', strtolower($this->type)]);
        }

        switch ($this->sort) {
            case 'position_asc':
                $query->orderBy("position ASC");
                break;
            default :
                $query->orderBy("position DESC");
        }

        $dataPage = new DataPage();
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
        $dataPage->pageCount = intval($dataPage->dataCount / $dataPage->pageSize);
        if ($dataPage->pageCount % $dataPage->pageSize != 0)
            $dataPage->pageCount = ceil($dataPage->pageCount) + 1;
        $dataPage->pageCount = $dataPage->pageCount < 1 ? 1 : $dataPage->pageCount;
        $ids = [];
        foreach ($dataPage->data as $item) {
            $ids[] = $item->id;
        }
        $images = Image::getByTarget($ids, ImageType::BANNER, false, true);
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
