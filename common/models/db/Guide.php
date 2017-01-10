<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "guide".
 *
 * @property integer $id
 * @property string $name
 * @property integer $createTime
 * @property string $createEmail
 * @property integer $updateTime
 * @property string $updateEmail
 * @property string $detail
 * @property integer $active
 * @property string $type
 * @property string $description
 */
class Guide extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'guide';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'createTime', 'createEmail', 'updateTime', 'updateEmail', 'detail', 'active', 'type', 'description'], 'required'],
            [['createTime', 'updateTime', 'active'], 'integer'],
            [['detail', 'description'], 'string'],
            [['name', 'createEmail', 'updateEmail', 'type'], 'string', 'max' => 220],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'createTime' => 'Create Time',
            'createEmail' => 'Create Email',
            'updateTime' => 'Update Time',
            'updateEmail' => 'Update Email',
            'detail' => 'Detail',
            'active' => 'Active',
            'type' => 'Type',
            'description' => 'Description',
        ];
    }
}
