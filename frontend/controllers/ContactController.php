<?php

namespace frontend\controllers;

use common\models\db\Contact;
use common\util\TextUtils;

class ContactController extends BaseController
{

    function actionContact()
    {
        $save = false;
        if (\Yii::$app->request->isPost) {
            $contact = new Contact();
            $contact->name = TextUtils::removeXSS(\Yii::$app->request->post('name'));
            $contact->email = TextUtils::removeXSS(\Yii::$app->request->post('email'));
            $contact->phone = TextUtils::removeXSS(\Yii::$app->request->post('phone'));
            $contact->note = TextUtils::removeXSS(\Yii::$app->request->post('content'));
            $contact->createTime = time();
            $save = $contact->save(false);
        }

        return $this->render('contact', [
            "saved" => $save,
        ]);
    }

}
