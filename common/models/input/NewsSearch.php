<?php

namespace common\models\input;

use common\models\db\Image;
use common\models\db\News;
use common\models\enu\ImageType;
use common\models\output\DataPage;
use yii\base\Model;
use yii\data\Pagination;

class NewsSearch extends Model {

    public $keyword;
    public $type;
    public $active;
    public $sort;
    public $page;
    public $pageSize;
    public $createEmail;
    public $updateEmail;
    public $createTimeFrom;
    public $updateTimeFrom;
    public $createTimeTo;
    public $updateTimeTo;
    public $w_thum = 0;
    public $h_thum = 0;

    public function rules() {
        return [
            [['keyword', 'sort', 'createEmail', 'updateEmail', 'type'], 'string'],
            [['pageSize', 'page', 'active', 'createTimeFrom', 'updateTimeFrom', 'createTimeTo', 'updateTimeTo'], 'integer'],
        ];
    }

    public function search($page = false) {
        $query = News::find();
        if ($this->keyword != null && $this->keyword != '') {
            $query->andWhere(['LIKE', 'name', strtolower($this->keyword)])->orWhere(['LIKE', 'detail', strtolower($this->keyword)])->orWhere(['LIKE', 'alias', strtolower($this->keyword)]);
        }
        if ($this->type != null && $this->type != '') {
            $query->andWhere(['=', 'type', $this->type]);
        }
        if ($this->active > 0) {
            $query->andWhere(['=', 'active', $this->active == 1 ? 1 : 0]);
        }
        switch ($this->sort) {
            case 'createTime_asc':
                $query->orderBy("createTime ASC");
                break;
            case 'active_asc':
                $query->orderBy("active ASC");
                break;
            case 'active_desc':
                $query->orderBy("active DESC");
                break;
            default :
                $query->orderBy("createTime DESC");
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
        $dataPage->pageCount = ($dataPage->dataCount / $dataPage->pageSize);
        if ($dataPage->pageCount % $dataPage->pageSize != 0)
            $dataPage->pageCount = ceil($dataPage->pageCount) + 1;
        $dataPage->pageCount = $dataPage->pageCount < 1 ? 1 : $dataPage->pageCount - 1;
        $ids = [];
        foreach ($dataPage->data as $item) {
            $ids[] = $item->id;
        }
        $images = Image::getByTarget($ids, ImageType::NEWS, false, true);
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
