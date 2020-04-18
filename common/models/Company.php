<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property integer $cid
 * @property integer $city_code
 * @property integer $bldg_code
 * @property string $name
 * @property integer $noslots
 */
class Company extends \yii\db\ActiveRecord
{
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_code', 'bldg_code', 'name', 'noslots'], 'required'],
            [['city_code', 'bldg_code', 'noslots'], 'integer'],
        	[['city_code'], 'exist', 'targetAttribute' => 'id', 'targetClass' => CityMaster::className()],
        	[['bldg_code'], 'exist', 'targetAttribute' => 'id', 'targetClass' => BuildingMaster::className()],
        	
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cid' => Yii::t('app', 'Cid'),
            'city_code' => Yii::t('app', 'City'),
            'bldg_code' => Yii::t('app', 'Building'),
            'name' => Yii::t('app', 'Name'),
            'noslots' => Yii::t('app', 'Number of slots'),
        ];
    }
    
//     public function Fields() {
//     	return [
    		
//     		'building2' => function() {
//     			return "dsfsdfsd";
// //     			return $this->water = \Yii::$app->formatter->asDecimal($this->water);
//     		},
    		
    		
//     		];
//     }
    
    
    
    /**
     * 
     * @return \yii\db\ActiveQuery
     */
    public function getCity() {
    	return $this->hasOne(CityMaster::className(), ['id' => 'city_code']);
    }
    
    /**
     * 
     * @return \yii\db\ActiveQuery
     */
    public function getBuilding() {
    	return $this->hasOne(BuildingMaster::className(), ['id' => 'bldg_code'])
    		->select('id, city_code, address, name')
    		->with('city');
    }
}
