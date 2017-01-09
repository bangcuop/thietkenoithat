<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property string $id
 * @property string $name
 * @property integer $categoryId
 * @property integer $createTime
 * @property integer $updateTime
 * @property double $sellPrice
 * @property string $description
 * @property string $details
 * @property integer $viewCount
 * @property integer $active
 * @property string $createEmail
 * @property string $updateEmail
 * @property integer $special
 * @property integer $bestSelling
 * @property integer $suggest
 * @property integer $position
 * @property integer $quantity
 * @property integer $color
 * @property integer $size
 * @property string $prototype
 */
class Item extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'item';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'name', 'categoryId'], 'required'],
            [['categoryId', 'createTime', 'updateTime', 'viewCount', 'active', 'special', 'bestSelling', 'suggest', 'position', 'quantity'], 'integer'],
            [['sellPrice'], 'number'],
            [['description', 'details', 'color', 'size'], 'string'],
            [['id','prototype'], 'string', 'max' => 32],
            [['name', 'color', 'size'], 'string', 'max' => 500],
            [['createEmail', 'updateEmail'], 'string', 'max' => 220],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'categoryId' => 'Category ID',
            'createTime' => 'Create Time',
            'updateTime' => 'Update Time',
            'sellPrice' => 'Sell Price',
            'description' => 'Description',
            'details' => 'Details',
            'viewCount' => 'View Count',
            'active' => 'Active',
            'createEmail' => 'Create Email',
            'special' => 'Special',
            'bestSelling' => 'Best Selling',
            'suggest' => 'Suggest',
            'position' => 'Position',
            'quantity' => 'Quantity',
            'color' => 'Color',
            'size' => 'Size',
            'prototype' => 'Prototype',
        ];
    }

    public function attributes() {
        return array_merge(parent::attributes(), ['images']);
    }

}
