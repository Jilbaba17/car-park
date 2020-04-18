<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "city_master".
 *
 * @property integer $id
 * @property string $name
 */
class CityMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
        	[['name'], 'unique'],
        	//['id', 'exist', 'targetAttribute' => 'city_code', 'targetClass' => BuildingMaster::className()],
            [['name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }
}
