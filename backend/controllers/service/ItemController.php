<?php

namespace backend\controllers\service;

use backend\models\ItemForm;
use common\models\business\ItemBusiness;
use common\models\input\ItemSearch;
use common\models\output\Response;
use Yii;

class ItemController extends ServiceController {

    public function init() {
        parent::init();
        $this->controller = "item";
    }

    /**
     * Lấy ra toàn bộ sản phẩm
     * return 
     */
    public function actionGrid() {
        if (is_object($resp = $this->can("grid"))) {
            return $this->response($resp);
        }
        $form = new ItemSearch();
        $form->setAttributes(Yii::$app->request->get());
        return $this->response(new Response(true, "Lấy dữ liệu search thành công", $form->search(true)));
    }

    public function actionAdd() {
        if (is_object($resp = $this->can("add"))) {
            return $this->response($resp);
        }
        $form = new ItemForm();
        $form->id = Yii::$app->request->post('id');
        $form->name = Yii::$app->request->post('name');
        $form->categoryId = Yii::$app->request->post('categoryId');
        $form->active = Yii::$app->request->post('active');
        $form->description = Yii::$app->request->post('description');
        $form->sellPrice = Yii::$app->request->post('sellPrice');
        $form->special = Yii::$app->request->post('special');
        $form->bestSelling = Yii::$app->request->post('bestSelling');
        $form->suggest = Yii::$app->request->post('suggest');
        $form->details = Yii::$app->request->post('details');
        $form->position = Yii::$app->request->post('position');
        $form->quantity = Yii::$app->request->post('quantity');
        $form->prototype = Yii::$app->request->post('prototype');
        $form->color = Yii::$app->request->post('color');
        $form->size = Yii::$app->request->post('size');
        return $this->response($form->save());
    }

    /**
     * change active
     * @return type
     */
    public function actionChangeactive() {
        if (is_object($resp = $this->can("changeactive"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get('id');
        return $this->response(ItemBusiness::changeActive($id));
    }

    /**
     * 
     * @return type
     */
    public function actionGetbyid() {
        if (is_object($resp = $this->can("getbyid"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get('id');
        $item = ItemBusiness::get($id);
        return $this->response(new Response(true, "Lấy dữ liệu thành công", $item));
    }

    /**
     * 
     * @return type
     */
    public function actionSavedetail() {
        if (is_object($resp = $this->can("savedetail"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get('id');
        $detail = Yii::$app->request->get('detail');
        return $this->response(ItemBusiness::saveDetail($id, $detail));
    }

    /**
     * 
     * @return type
     */
    public function actionRemove() {
        if (is_object($resp = $this->can("remove"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get('id');
        return $this->response(ItemBusiness::remove($id));
    }

    public function actionEdit() {
        if (is_object($resp = $this->can("edit"))) {
            return $this->response($resp);
        }
        $form = new ItemForm();
        $form->id = Yii::$app->request->post('id');
        $form->name = Yii::$app->request->post('name');
        $form->categoryId = Yii::$app->request->post('categoryId');
        $form->active = Yii::$app->request->post('active');
        $form->description = Yii::$app->request->post('description');
        $form->sellPrice = Yii::$app->request->post('sellPrice');
        $form->special = Yii::$app->request->post('special');
        $form->bestSelling = Yii::$app->request->post('bestSelling');
        $form->suggest = Yii::$app->request->post('suggest');
        $form->details = Yii::$app->request->post('details');
        $form->position = Yii::$app->request->post('position');
        $form->quantity = Yii::$app->request->post('quantity');
        $form->prototype = Yii::$app->request->post('prototype');
        $form->color = Yii::$app->request->post('color');
        $form->size = Yii::$app->request->post('size');
        return $this->response($form->edit());
    }

}
