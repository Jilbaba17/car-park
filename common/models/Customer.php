<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property integer $cid
 * @property integer $bldg_code
 * @property string $name
 * @property integer $noslots
 */
class Customer extends \yii\db\ActiveRecord
{
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bldg_code', 'name', 'noslots'], 'required'],
            [['bldg_code', 'noslots'], 'integer'],
        	[['bldg_code'], 'exist', 'targetAttribute' => 'id', 'targetClass' => Block::className()],
        	
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
    public function getBuilding() {
    	return $this->hasOne(Block::className(), ['id' => 'bldg_code'])
    		->select('id, address, name');
    }
}
