<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parkingslip".
 *
 * @property int $parking_slip_id
 * @property int $parking_slip_customerid
 * @property string $parking_slip_carplatenumber
 * @property string $parking_slip_carcolor
 * @property string $parking_slip_datefrom
 * @property string $parking_slip_date
 * @property int $parking_slip_slotnumber
 * @property string $parking_slip_dateto
 * @property int $parking_slip_parkid
 *
 * @property Customer $parkingSlipCustomer
 * @property Parkinglot $parkingSlipPark
 * @property Payments $payments
 */
class ParkingSlip extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parkingslip';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parking_slip_customerid', 'parking_slip_carplatenumber', 'parking_slip_carcolor', 'parking_slip_datefrom', 'parking_slip_date', 'parking_slip_slotnumber', 'parking_slip_dateto', 'parking_slip_parkid'], 'required'],
            [['parking_slip_customerid', 'parking_slip_slotnumber', 'parking_slip_parkid'], 'integer'],
            [['parking_slip_datefrom', 'parking_slip_date', 'parking_slip_dateto'], 'safe'],
            [['parking_slip_carplatenumber', 'parking_slip_carcolor'], 'string', 'max' => 11],
            [['parking_slip_parkid'], 'unique'],
            [['parking_slip_customerid'], 'unique'],
            [['parking_slip_customerid'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['parking_slip_customerid' => 'customer_id']],
            [['parking_slip_parkid'], 'exist', 'skipOnError' => true, 'targetClass' => Parkinglot::className(), 'targetAttribute' => ['parking_slip_parkid' => 'park_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'parking_slip_id' => 'Parking Slip ID',
            'parking_slip_customerid' => 'Parking Slip Customerid',
            'parking_slip_carplatenumber' => 'Parking Slip Carplatenumber',
            'parking_slip_carcolor' => 'Parking Slip Carcolor',
            'parking_slip_datefrom' => 'Parking Slip Datefrom',
            'parking_slip_date' => 'Parking Slip Date',
            'parking_slip_slotnumber' => 'Parking Slip Slotnumber',
            'parking_slip_dateto' => 'Parking Slip Dateto',
            'parking_slip_parkid' => 'Parking Slip Parkid',
        ];
    }

    /**
     * Gets query for [[ParkingSlipCustomer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParkingSlipCustomer()
    {
        return $this->hasOne(Customer::className(), ['customer_id' => 'parking_slip_customerid']);
    }

    /**
     * Gets query for [[ParkingSlipPark]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParkingSlipPark()
    {
        return $this->hasOne(Parkinglot::className(), ['park_id' => 'parking_slip_parkid']);
    }

    /**
     * Gets query for [[Payments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasOne(Payments::className(), ['payment_parking_slip_id' => 'parking_slip_id']);
    }
}
