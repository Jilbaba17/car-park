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
class Administrator extends Login
{

    public $role = 'ADMIN';

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
            [['admin_emailaddress'], 'email'],
            [['admin_emailaddress', 'admin_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'admin_id' => 'Admin ID',
            'admin_loginid' => 'Admin Login',
            'admin_contact' => 'Admin Contact',
            'admin_name' => 'Admin Name',
            'admin_emailaddress' => 'Admin Email Address',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne(['admin_id' => $id]);
        // return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }


    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {

        return null;
    }

    public static function findByAdminLoginId($adminLoginId)
    {
        $user = Administrator::find()->where('admin_loginid=:hash', [':hash' => $adminLoginId])->one();
        if ($user) {
            return new static($user);
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->admin_id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return null;
    }
    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return null;
    }

    /**
     * Validates login code
     *
     * @param string $adminLoginId password to validate
     * @return bool if password provided is valid for current user
     */
    public function validateAdminLogin($adminLoginId)
    {
        return $this->admin_loginid === (int) $adminLoginId;
    }
}
