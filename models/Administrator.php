<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "administrator".
 *
 * @property int $admin_id
 * @property int $admin_loginid
 * @property int $admin_contact
 * @property string $admin_name
 * @property string $admin_emailaddress
 *
 * @property Login $adminLogin
 * @property Login $adminLogin0
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
            [['admin_loginid', 'admin_contact', 'admin_name', 'admin_emailaddress'], 'required'],
            [['admin_loginid', 'admin_contact'], 'integer'],
            [['admin_name'], 'string', 'max' => 11],
            [['admin_emailaddress'], 'string', 'max' => 100],
            [['admin_loginid'], 'unique'],
            [['admin_loginid'], 'exist', 'skipOnError' => true, 'targetClass' => Login::className(), 'targetAttribute' => ['admin_loginid' => 'login_id']],
            [['admin_loginid'], 'exist', 'skipOnError' => true, 'targetClass' => Login::className(), 'targetAttribute' => ['admin_loginid' => 'login_id']],
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

    /**
     * Gets query for [[AdminLogin]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdminLogin()
    {
        return $this->hasOne(Login::className(), ['login_id' => 'admin_loginid']);
    }

    /**
     * Gets query for [[AdminLogin0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdminLogin0()
    {
        return $this->hasOne(Login::className(), ['login_id' => 'admin_loginid']);
    }
}
