<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $customer_id
 * @property int $customer_contact
 * @property string $customer_regularornew
 * @property string $customer_registrationdate
 * @property int $customer_loginid
 *
 * @property Login $customerLogin
 * @property Parkingslip $parkingslip
 */
class Customer extends \yii\db\ActiveRecord
{

    const SCENARIO_CREATE = 'create';
    const CUSTOMER_TYPE = [
        'New', 'Regular'
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_contact', 'customer_regularornew', 'customer_loginid'], 'required'],
            [['customer_contact', 'customer_loginid'], 'integer'],
            [['customer_registrationdate'], 'safe'],
            ['customer_registrationdate', 'default', 'value' => date('Y-m-d'), 'on' => self::SCENARIO_CREATE],
            [['customer_regularornew'], 'string', 'max' => 11],
            [['customer_loginid'], 'unique'],
            [['customer_loginid'], 'exist', 'skipOnError' => true, 'targetClass' => Login::className(), 'targetAttribute' => ['customer_loginid' => 'login_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => 'Customer ID',
            'customer_contact' => 'Customer Contact',
            'customer_regularornew' => 'Customer Regularornew',
            'customer_registrationdate' => 'Customer Registrationdate',
            'customer_loginid' => 'Customer Loginid',
        ];
    }

    /**
     * Gets query for [[CustomerLogin]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerLogin()
    {
        return $this->hasOne(Login::className(), ['login_id' => 'customer_loginid']);
    }

    /**
     * Gets query for [[Parkingslip]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParkingslip()
    {
        return $this->hasOne(Parkingslip::className(), ['parking_slip_customerid' => 'customer_id']);
    }
}
