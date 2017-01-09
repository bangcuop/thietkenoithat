<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "banner".
 *
 * @property integer $id
 * @property string $name
 * @property integer $active
 * @property string $link
 * @property string $type
 * @property integer $position
 * @property string $description
 */
class Banner extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'banner';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['active', 'position'], 'integer'],
            [['name', 'link','description'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'Mã'),
            'name' => Yii::t('app', 'Tên'),
            'active' => Yii::t('app', 'Trạng thái'),
            'link' => Yii::t('app', 'Link'),
            'type' => Yii::t('app', 'Kiểu'),
            'position' => Yii::t('app', 'Thứ tự'),
            'description' => Yii::t('app', 'Mô tả'),
        ];
    }

    /**
     * 
     * @return type
     */
    public function attributes() {
        return array_merge(parent::attributes(), ['images']);
    }

}
