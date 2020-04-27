<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parking_lot".
 *
 * @property int $tagid
 * @property int|null $employee_code
 * @property int|null $customer_id
 * @property string|null $car_model
 * @property string|null $car_regno
 * @property int|null $tagstatus
 * @property string|null $created_on
 * @property string|null $doissue
 *
 * @property Customer $customer
 * @property ParkingSlip[] $parkingSlips
 */
class ParkingLot extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parking_lot';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tagid'], 'required'],
            [['tagid', 'employee_code', 'customer_id', 'tagstatus'], 'integer'],
            [['created_on', 'doissue'], 'safe'],
            [['car_model'], 'string', 'max' => 50],
            [['car_regno'], 'string', 'max' => 12],
            [['tagid'], 'unique'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'cid']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tagid' => 'Tagid',
            'employee_code' => 'Employee Code',
            'customer_id' => 'Customer ID',
            'car_model' => 'Car Model',
            'car_regno' => 'Car Regno',
            'tagstatus' => 'Tagstatus',
            'created_on' => 'Created On',
            'doissue' => 'Doissue',
        ];
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['cid' => 'customer_id']);
    }

    /**
     * Gets query for [[ParkingSlips]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParkingSlips()
    {
        return $this->hasMany(ParkingSlip::className(), ['tagid' => 'tagid']);
    }
}
