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
 */
class Customer extends \yii\db\ActiveRecord
{
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
            [['customer_contact', 'customer_regularornew', 'customer_registrationdate', 'customer_loginid'], 'required'],
            [['customer_contact', 'customer_loginid'], 'integer'],
            [['customer_registrationdate'], 'safe'],
            [['customer_regularornew'], 'string', 'max' => 11],
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
}
