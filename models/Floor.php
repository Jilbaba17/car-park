<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "floor".
 *
 * @property int $floor_id
 * @property int $floor_number
 * @property string $floor_maxheight
 * @property int $floor_numberofblocks
 */
class Floor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'floor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['floor_number', 'floor_maxheight', 'floor_numberofblocks'], 'required'],
            [['floor_number', 'floor_numberofblocks'], 'integer'],
            [['floor_maxheight'], 'string', 'max' => 11],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'floor_id' => 'Floor ID',
            'floor_number' => 'Floor Number',
            'floor_maxheight' => 'Floor Maxheight',
            'floor_numberofblocks' => 'Floor Numberofblocks',
        ];
    }
}
