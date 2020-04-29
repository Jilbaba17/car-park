<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "block".
 *
 * @property int $block_id
 * @property int $block_floorid
 * @property string $block_code
 * @property int $block_capacity
 */
class Block extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'block';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['block_floorid', 'block_code', 'block_capacity'], 'required'],
            [['block_floorid', 'block_capacity'], 'integer'],
            [['block_code'], 'string', 'max' => 11],
            [['block_floorid'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'block_id' => 'Block ID',
            'block_floorid' => 'Block Floorid',
            'block_code' => 'Block Code',
            'block_capacity' => 'Block Capacity',
        ];
    }
}
