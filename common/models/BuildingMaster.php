<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "building_master".
 *
 * @property integer $id
 * @property string $name
 * @property integer $city_code
 * @property integer $tot_slots
 * @property string $address
 */
class BuildingMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'building_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'city_code', 'tot_slots', 'address'], 'required'],
            [['city_code', 'tot_slots'], 'integer'],
            [['name'], 'string', 'max' => 200],
            [['address'], 'string', 'max' => 255],
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
            'city_code' => Yii::t('app', 'City Code'),
            'tot_slots' => Yii::t('app', 'Tot Slots'),
            'address' => Yii::t('app', 'Address'),
        ];
    }
    
    /**
     * 
     * @return \yii\db\ActiveQuery
     */
    public function getCity() {
    	return $this->hasOne(CityMaster::className(), ['id' => 'city_code']);
    }
}
