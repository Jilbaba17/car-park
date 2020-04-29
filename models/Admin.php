<?php

namespace app\models;

class Admin extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $login_id;
    public $login_code;
    public $login_rank;
    public $admin_loginid;
    public $role;




    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

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
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }
    public static function findByLoginCode($loginCode)
    {
        $user = Login::find()->where('login_code=:code', [':code' => $loginCode])->one();
        if ($user) {
            return new static($user);
        }

        return null;

    }
    public static function findByAdminLoginId($adminLoginId)
    {
        $user = Administrator::find()->where('admin_loginid=:hash', [':hash' => $adminLoginId]);
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
        var_dump($this); die;
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates login code
     *
     * @param string $loginCode password to validate
     * @return bool if password provided is valid for current user
     */
    public function validateLoginCode($loginCode)
    {
        return $this->login_code === (int) $loginCode;
    }
    public function validateAdminLoginId($adminLoginId)
    {
        return $this->admin_loginid === (int) $adminLoginId;
    }
}
