<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parking_slip".
 *
 * @property int $id
 * @property int $tagid
 * @property string|null $intime
 * @property string|null $outtime
 * @property int $status 1 is in 0 is out
 *
 * @property ParkingLot $tag
 * @property Payments[] $payments
 */
class ParkingSlip extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parking_slip';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tagid', 'status'], 'required'],
            [['tagid', 'status'], 'integer'],
            [['intime', 'outtime'], 'safe'],
            [['tagid'], 'exist', 'skipOnError' => true, 'targetClass' => ParkingLot::className(), 'targetAttribute' => ['tagid' => 'tagid']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tagid' => 'Tagid',
            'intime' => 'Intime',
            'outtime' => 'Outtime',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Tag]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(ParkingLot::className(), ['tagid' => 'tagid']);
    }

    /**
     * Gets query for [[Payments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payments::className(), ['Payment_Parking slip id' => 'id']);
    }
}
