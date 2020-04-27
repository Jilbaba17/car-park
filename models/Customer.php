<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $cid
 * @property int $bldg_code
 * @property string $name
 * @property int $noslots
 *
 * @property Block $bldgCode
 * @property ParkingLot[] $parkingLots
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
            [['bldg_code', 'name', 'noslots'], 'required'],
            [['bldg_code', 'noslots'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['bldg_code'], 'exist', 'skipOnError' => true, 'targetClass' => Block::className(), 'targetAttribute' => ['bldg_code' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cid' => 'Cid',
            'bldg_code' => 'Bldg Code',
            'name' => 'Name',
            'noslots' => 'Noslots',
        ];
    }

    /**
     * Gets query for [[BldgCode]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBldgCode()
    {
        return $this->hasOne(Block::className(), ['id' => 'bldg_code']);
    }

    /**
     * Gets query for [[ParkingLots]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParkingLots()
    {
        return $this->hasMany(ParkingLot::className(), ['customer_id' => 'cid']);
    }
}
