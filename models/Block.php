<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "block".
 *
 * @property int $id
 * @property string|null $name
 * @property int $tot_slots
 * @property string $address
 *
 * @property Customer[] $customers
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
            [['tot_slots', 'address'], 'required'],
            [['tot_slots'], 'integer'],
            [['name'], 'string', 'max' => 200],
            [['address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'tot_slots' => 'Tot Slots',
            'address' => 'Address',
        ];
    }

    /**
     * Gets query for [[Customers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['bldg_code' => 'id']);
    }
}
