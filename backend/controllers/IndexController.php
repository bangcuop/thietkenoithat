<?php

namespace backend\controllers;

class IndexController extends BaseController {

    public function actionIndex() {
        return $this->render("view", [
        ]);
    }

    public function actionOpenid() {
        $params = Yii::$app->request->get();
        $resp = WsClient::getInfo($params['token'], $params['appId']);
        if (!$resp->success) {
            return $this->render("//error/500", [
                        "message" => $resp->message
            ]);
        }
        $form = new SiginForm();
        $form->email = $resp->data->id;
        $form->description = "Sigin system passport Id";
        $resp = $form->signin();
        if (!$resp->success) {
            return $this->render("//error/500", [
                        "message" => $resp->message
            ]);
        }
        $auth = new Auth();
        $auth->id = $resp->data->id;
        $auth->authKey = md5($resp->data->id . "-thehoa268-" . $resp->data->joinTime);
        Yii::$app->user->login($auth, 1);
        return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl("index/index"));
    }

}
