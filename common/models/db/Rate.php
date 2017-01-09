<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "rate".
 *
 * @property integer $time
 * @property double $rate
 */
class Rate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time'], 'required'],
            [['time'], 'integer'],
            [['rate'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'time' => Yii::t('app', 'Time'),
            'rate' => Yii::t('app', 'Rate'),
        ];
    }
}
