<?php

namespace backend\controllers\service;

use backend\models\UploadForm;
use common\models\db\Image;
use common\models\output\Response;
use Yii;
use yii\web\UploadedFile;

class ImageController extends ServiceController {

    public function init() {
        parent::init();
        $this->controller = Image::getTableSchema()->name;
    }

//    public function actionIndex() {
//        if (is_object($resp = $this->can("grid"))) {
//            return $this->response($resp);
//        }
//        $this->view->title = "Danh sách hình ảnh";
//        return $this->render("view");
//    }

    /**
     * 
     * @return type
     */
    public function actionAdd() {
//        if (is_object($resp = $this->can("add"))) {
//            return $this->response($resp);
//        }
        $targetId = strval(Yii::$app->request->get('target'));
        $type = Yii::$app->request->get('type');
        $form = new UploadForm();
        $form->setAttributes(Yii::$app->request->post());
        $form->imageFile = UploadedFile::getInstanceByName('imageFile');
        if (!empty($form->imageFile)) {
            return $this->response(Image::upload($form->imageFile, $type, $targetId, $position = 1, $thumbnail = [], $form->name));
        }
        return $this->response(Image::dowload($form->url, $type, $targetId, $position = 1, $thumbnail = [], $form->name));
    }

    /**
     * 
     * @return type
     */
    public function actionGetbytarget() {
//        if (is_object($resp = $this->can("getbytarget"))) {
//            return $this->response($resp);
//        }
        $targetId = json_decode(Yii::$app->request->get('target'));
        if ($targetId == null)
            $targetId = trim(Yii::$app->request->get('target'));
        $type = Yii::$app->request->get('type');
        $url = Yii::$app->request->get('url');
        $image = Image::getByTarget($targetId, $type, $url == true, true);
        return $this->response(new Response(true, "Image", $image));
    }

    /**
     * 
     * @return type
     */
    public function actionRemove() {
//        if (is_object($resp = $this->can("remove"))) {
//            return $this->response($resp);
//        }
        $id = Yii::$app->request->get('id');
        $image = Image::findOne($id);
        if (!empty($image)) {
            Image::deleteByImageId($image->imageId);
        }
        return $this->response(new Response(true, "Image has been deleted from the system"));
    }

    /**
     * image load
     * @return type
     */
    public function actionLoad() {
        $id = Yii::$app->request->get('ids');
        $targetIds = Yii::$app->request->get('targets');
        $type = Yii::$app->request->get('type');
        $images = Image::getByTarget($targetIds, $type, true, true);
        return $this->response(new Response(true, "Danh sách image", $images));
    }

}
