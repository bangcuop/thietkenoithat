<?php

namespace common\models\db;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "api_assignment".
 *
 * @property string $administratorId
 * @property string $sourceId
 * @property integer $role
 */
class ApiAssignment extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'api_assignment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['administratorId', 'sourceId', 'role'], 'required'],
            [['role'], 'integer'],
            [['administratorId'], 'string', 'max' => 220],
            [['sourceId'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'administratorId' => Yii::t('app', 'Administrator ID'),
            'sourceId' => Yii::t('app', 'Source ID'),
            'role' => Yii::t('app', 'Role'),
        ];
    }
}