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
class customer extends \yii\db\ActiveRecord
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
            [['customer_bldg_code', 'customer_name', 'customer_noslots'], 'required'],
            [['customer_bldg_code', 'customer_noslots'], 'integer'],
        	[['customer_bldg_code'], 'exist', 'targetAttribute' => 'Block_id', 'targetClass' => Block::className()],
        	
            [['customer_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => Yii::t('app', 'customer_id'),
            'customer_bldg_code' => Yii::t('app', 'Building'),
            'customer_name' => Yii::t('app', 'Name'),
            'customer_noslots' => Yii::t('app', 'Number of slots'),
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
    public function getBlock() {
    	return $this->hasOne(Block::className(), ['Block_id' => 'customer_bldg_code'])
    		->select('Block_id, Block_address, Block_name');
    }
}
