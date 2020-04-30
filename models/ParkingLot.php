<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parkinglot".
 *
 * @property int $park_id
 * @property int $park_code
 * @property int $park_blockid
 * @property string $park_valetparking
 * @property int $park_slotnumberfrom
 * @property int $park_slotnumberto
 *
 * @property Parkingslip $parkingslip
 */
class ParkingLot extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parkinglot';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['park_code', 'park_blockid', 'park_valetparking', 'park_slotnumberfrom', 'park_slotnumberto'], 'required'],
            [['park_code', 'park_blockid', 'park_slotnumberfrom', 'park_slotnumberto'], 'integer'],
            [['park_valetparking'], 'string', 'max' => 11],
            [['park_blockid'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'park_id' => 'Park ID',
            'park_code' => 'Park Code',
            'park_blockid' => 'Park Blockid',
            'park_valetparking' => 'Park Valetparking',
            'park_slotnumberfrom' => 'Park Slotnumberfrom',
            'park_slotnumberto' => 'Park Slotnumberto',
        ];
    }

    /**
     * Gets query for [[Parkingslip]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParkingslip()
    {
        return $this->hasOne(Parkingslip::className(), ['parking_slip_parkid' => 'park_id']);
    }
}
