<?php

namespace backend\models;

use common\models\business\ContactBusiness;
use common\models\db\Contact;
use common\models\output\Response;
use yii\base\Model;

class ContactForm extends Model {

    public $id;
    public $name;
    public $address;
    public $phone;
    public $email;
    public $note;

    public function rules() {
        return [
            [['name', 'phone', 'email', 'address'], 'required', 'message' => '{attribute} không được để trống!'],
            [['id'], 'integer', 'message' => '{attribute} phải là số !'],
            [['note', 'name', 'email'], 'string', 'message' => '{attribute} phải là ký tự !'],
            [['phone'], 'number', 'message' => '{attribute} phải là số !'],
            [['email'], 'email', 'message' => '{attribute} không đúng định dạng !'],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => "Mã liên hệ",
            'name' => "Tên liên hệ",
            'email' => "Email",
            'address' => "Địa chỉ",
            'phone' => "Số điện thoại",
            'note' => "Ghi chú",
        ];
    }

    public function save() {
        if (!$this->validate()) {
            return new Response(false, "Dữ liệu không hợp lệ !", $this->errors);
        }
        $contact = ContactBusiness::get($this->id);
        if ($contact == null) {
            $contact = new Contact();
            $contact->createTime = time();
        }
        $contact->name = $this->name;
        $contact->phone = '0' . $this->phone;
        if ($contact->email != $this->email) {
            if (!empty(ContactBusiness::getByEmail($this->email))) {
                return new Response(false, "Email đã tồn tại ", []);
            }
        }
        $contact->email = $this->email;
        $contact->address = $this->address;
        $contact->note = $this->note;
        $contact->updateTime = time();
        if (!$contact->save(false)) {
            return new Response(false, "Không lưu được vào csdl", $contact->errors);
        }
        return new Response(true, "Lưu ok", $contact);
    }

}
