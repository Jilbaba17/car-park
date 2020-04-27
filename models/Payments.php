<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payments".
 *
 * @property int $Payment_id
 * @property string $Payment_mode
 * @property string $Payment_reference
 * @property int|null $Payment_Parking slip id
 * @property int $Payment_amount
 *
 * @property ParkingSlip $paymentParkingSlip
 */
class Payments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Payment_id', 'Payment_mode', 'Payment_reference', 'Payment_amount'], 'required'],
            [['Payment_id', 'Payment_Parking slip id', 'Payment_amount'], 'integer'],
            [['Payment_mode', 'Payment_reference'], 'string', 'max' => 100],
            [['Payment_id'], 'unique'],
            [['Payment_Parking slip id'], 'exist', 'skipOnError' => true, 'targetClass' => ParkingSlip::className(), 'targetAttribute' => ['Payment_Parking slip id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Payment_id' => 'Payment ID',
            'Payment_mode' => 'Payment Mode',
            'Payment_reference' => 'Payment Reference',
            'Payment_Parking slip id' => 'Payment Parking Slip ID',
            'Payment_amount' => 'Payment Amount',
        ];
    }

    /**
     * Gets query for [[PaymentParkingSlip]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentParkingSlip()
    {
        return $this->hasOne(ParkingSlip::className(), ['id' => 'Payment_Parking slip id']);
    }
}
