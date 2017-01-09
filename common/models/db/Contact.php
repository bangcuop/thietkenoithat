<?php

namespace common\models\db;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "contact".
 *
 * @property integer $id
 * @property integer $createTime
 * @property string $name
 * @property integer $phone
 * @property string $email
 * @property string $note
 */
class Contact extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createTime', 'name', 'phone', 'email', 'note'], 'required'],
            [['createTime', 'phone'], 'integer'],
            [['note'], 'string'],
            [['name', 'email'], 'string', 'max' => 220],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'createTime' => 'Create Time',
            'name' => 'Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'note' => 'Note',
        ];
    }
}
