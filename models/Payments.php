<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payments".
 *
 * @property int $payment_id
 * @property string $payment_mode
 * @property string $payment_reference
 * @property int $payment_parking_slip_id
 * @property int $payment_amount
 *
 * @property Parkingslip $paymentParkingSlip
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
            [['payment_mode', 'payment_parking_slip_id', 'payment_amount'], 'required'],
            [['payment_parking_slip_id', 'payment_amount'], 'integer'],
            [['payment_reference'], 'default', 'value' => 'none'],
            [['payment_mode', 'payment_reference'], 'string', 'max' => 11],
            [['payment_parking_slip_id'], 'exist', 'skipOnError' => true, 'targetRelation' => 'paymentParkingSlip'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'payment_id' => 'Payment ID',
            'payment_mode' => 'Payment Mode',
            'payment_reference' => 'Payment Reference',
            'payment_parking_slip_id' => 'Payment Parking Slip ID',
            'payment_amount' => 'Payment Amount',
        ];
    }

    /**
     * Gets query for [[PaymentParkingSlip]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentParkingSlip()
    {
        return $this->hasOne(ParkingSlip::className(), ['parking_slip_id' => 'payment_parking_slip_id']);
    }
}
