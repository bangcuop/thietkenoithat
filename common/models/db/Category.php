<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $createTime
 * @property integer $updateTime
 * @property integer $parentId
 * @property integer $active
 * @property integer $position
 * @property string $description
 * @property integer $leaf
 * @property integer $level
 * @property string $path
 */
class Category extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'createTime', 'updateTime', 'parentId', 'active', 'position', 'description'], 'required'],
            [['createTime', 'updateTime', 'parentId', 'active', 'position', 'leaf', 'level'], 'integer'],
            [['name'], 'string', 'max' => 220],
            [['description'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'createTime' => 'Create Time',
            'updateTime' => 'Update Time',
            'parentId' => 'Parent ID',
            'active' => 'Active',
            'position' => 'Position',
            'description' => 'Description',
            'leaf' => 'Leaf',
            'level' => 'Level',
            'path' => 'Path'
        ];
    }

    public function attributes() {
        return array_merge(parent::attributes(), ['child']);
    }

}
