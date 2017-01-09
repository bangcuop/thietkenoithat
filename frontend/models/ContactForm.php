<?php

namespace frontend\models;

use common\models\business\ContactBusiness;
use common\models\db\Contact;
use common\models\output\Response;
use yii\base\Model;

class ContactForm extends Model {

    public $id;
    public $name;
    public $phone;
    public $email;
    public $note;

    public function rules() {
        return [
            [['id'], 'integer', 'message' => '{attribute} phải là số !'],
            [['note', 'name', 'email'], 'string', 'message' => '{attribute} phải là ký tự !'],
            [['phone'], 'number', 'message' => '{attribute} phải là số !'],
            [['email'], 'email', 'message' => '{attribute} không đúng định dạng !'],
            [['email'], 'required', 'message' => '{attribute} không được để trống !'],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => "Mã liên hệ",
            'name' => "Tên liên hệ",
            'email' => "Email",
            'phone' => "Số điện thoại",
            'note' => "Nội dung liê hệ",
        ];
    }

    public function save() {
        if (!$this->validate()) {
            return new Response(false, "Dữ liệu nhập vào chưa chính xác!", $this->errors);
        }
        $contact = new Contact();
        $contact->createTime = time();
        $contact->email = $this->email;
        $contact->name = $this->name;
        $contact->phone = $this->phone;
        $contact->note = $this->note;
        if (!$contact->save(false)) {
            return new Response(false, "Không lưu được vào csdl", $contact->errors);
        }
        return new Response(true, "Gửi liên hệ thành công!", $contact);
    }

}
