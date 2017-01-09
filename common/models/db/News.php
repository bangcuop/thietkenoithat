<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $description
 * @property string $name
 * @property string $type
 * @property integer $createTime
 * @property string $createEmail
 * @property integer $updateTime
 * @property string $updateEmail
 * @property string $detail
 * @property integer $active
 */
class News extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'createEmail', 'updateEmail', 'detail', 'description'], 'required'],
            [['createTime', 'updateTime', 'active'], 'integer'],
            [['detail', 'description'], 'string'],
            [['name', 'createEmail', 'updateEmail', 'type'], 'string', 'max' => 220]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'description' => Yii::t('app', 'Description'),
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'createTime' => Yii::t('app', 'Create Time'),
            'createEmail' => Yii::t('app', 'Create Email'),
            'updateTime' => Yii::t('app', 'Update Time'),
            'updateEmail' => Yii::t('app', 'Update Email'),
            'detail' => Yii::t('app', 'Detail'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    public function attributes() {
        return array_merge(parent::attributes(), ['images']);
    }

}
