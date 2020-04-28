<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "administrator".
 *
 * @property int $admin_id
 * @property int $admin_loginid
 * @property int $admin_contact
 * @property int $admin_name
 * @property string $admin_emailaddress
 */
class Administrator extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'administrator';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['admin_id', 'admin_loginid', 'admin_contact', 'admin_name', 'admin_emailaddress'], 'required'],
            [['admin_id', 'admin_loginid', 'admin_contact', 'admin_name'], 'integer'],
            [['admin_emailaddress'], 'string', 'max' => 100],
            [['admin_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'admin_id' => 'Admin ID',
            'admin_loginid' => 'Admin Loginid',
            'admin_contact' => 'Admin Contact',
            'admin_name' => 'Admin Name',
            'admin_emailaddress' => 'Admin Emailaddress',
        ];
    }
}
