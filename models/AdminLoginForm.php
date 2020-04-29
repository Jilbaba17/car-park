<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class AdminLoginForm extends Model
{
    public $admin_loginid;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            //  admin_loginid is required
            [['admin_loginid'],'required'],
            // login_code is validated by validatePassword()
            // rememberMe must be a boolean value
            ['rememberMe','boolean'],
            ['admin_loginid','validatePassword']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'admin_loginid' => 'Admin Login',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validateAdminLogin($this->admin_loginid)){
                $this->addError($attribute, 'Incorrect admin login ID.');
            }
        }
    }

    /**
     * Logs in a user using the provided password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return Administrator|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Administrator::findByAdminLoginId($this->admin_loginid);
            Yii::$app->session['isAdmin'] = true;
        }

        return $this->_user;
    }
}
