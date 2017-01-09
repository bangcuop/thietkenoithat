<?php

namespace backend\controllers\service;

use backend\models\CategoryForm;
use common\models\business\CategoryBusiness;
use common\models\db\Category;
use common\models\output\Response;
use Yii;

class CategoryController extends ServiceController {

    public function init() {
        parent::init();
        $this->controller = Category::getTableSchema()->name;
    }

    /**
     * List category
     * @return type
     */
    public function actionGrid() {
        if (is_object($resp = $this->can("grid"))) {
            return $this->response($resp);
        }
        $category = CategoryBusiness::getAll();
        return $this->response(new Response(true, "Danh sách danh mục", $category));
    }

    /**
     * Change active category
     * @return type
     */
    public function actionChangeactive() {
        if (is_object($resp = $this->can("changeactive"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get("id");
        return CategoryBusiness::changeActive($id);
    }

   
    /**
     * Thay đổi vị trí hiển thị của danh mục
     * @return type
     */
    public function actionChangeposition() {
        if (is_object($resp = $this->can("changeposition"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get("id");
        $position = Yii::$app->request->get("position");
        return CategoryBusiness::changePosition($id, $position);
    }

    /**
     * Xóa danh mục, danh mục có chứa danh mục con thì đéo được xóa
     * @return type
     */
    public function actionRemove() {
        if (is_object($resp = $this->can("remove"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get("id");
        return CategoryBusiness::remove($id);
    }

    /**
     * Get all category
     * @return Response
     */
    public function actionGetall() {
        if (is_object($resp = $this->can("getall"))) {
            return $this->response($resp);
        }
        return new Response(true, "List all category", CategoryBusiness::getAll());
    }

    /**
     * Thêm mới danh mục
     * @return type
     */
    public function actionAdd() {
        if (is_object($resp = $this->can("add"))) {
            return $this->response($resp);
        }
        $form = new CategoryForm();
        $form->setAttributes($form->setAttributes(Yii::$app->request->getBodyParams()));
        return $this->response($form->Add());
    }

    /**
     * Lấy chi tiết danh mục
     * @return Response
     */
    public function actionGet() {
        if (is_object($resp = $this->can("get"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get("id");
        $category = CategoryBusiness::get($id);
        if ($category == null) {
            return new Response(false, "Danh mục không tồn tại trên hệ thống!");
        }
        return new Response(true, "Chi tiết danh mục", $category);
    }

    /**
     * Sửa danh mục
     * @return type
     */
    public function actionEdit() {
        if (is_object($resp = $this->can("edit"))) {
            return $this->response($resp);
        }
        $form = new CategoryForm();
        $form->setAttributes($form->setAttributes(Yii::$app->request->getBodyParams()));
        return $this->response($form->edit());
    }


    public function actionGetallactive() {
        if (is_object($resp = $this->can("getallactive"))) {
            return $this->response($resp);
        }
        return $this->response(new Response(true, '', CategoryBusiness::getAll(1)));
    }
   
}
