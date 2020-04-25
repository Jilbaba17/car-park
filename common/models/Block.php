<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "building_master".
 *
 * @property integer $id
 * @property string $name
 * @property integer $city_code
 * @property integer $tot_slots
 * @property string $address
 */
class Block extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'block';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Block_name', 'Block_tot_slots', 'Block_address'], 'required'],
            [['Block_tot_slots'], 'integer'],
            [['Block_name'], 'string', 'max' => 200],
            [['Block_address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'block_id' => Yii::t('app', 'Block ID'),
            
        ];
    }
    
    

    /**
     * @return array
     */
    public static function getBlocks() {
        $blocksArray = [];
        $rsBlocks = Block::find()->select('Block_id, Block_name')->asArray()->all();
        $blocksArray = ArrayHelper::map($rsBlocks, 'Block_id', 'Block_name');
        return $blocksArray;
    }
}
