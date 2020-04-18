<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends \dektrium\user\models\LoginForm
{
    public $username;
    public $password;
    public $phone_number;
    public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
           // [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
           // ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            //['password', 'validatePassword'],
            ['phone_number', 'required'],
            ['phone_number', 'isTenNumbersOnly'],
            ['phone_number', 'validatePhoneNumber']
        ];
    }
    
    public function isTenNumbersOnly($attribute) {
        if (!preg_match('/^[0-9]{10}$/', $this->$attribute)) {
            $this->addError($attribute, 'Must contain exactly 10 digits.');
        }
    }

    public function validatePhoneNumber($attribute, $params) {
        if(!$this->hasErrors()) {
            $user = $this->getUserByPhoneNumber($this->phone_number);
            if(!$user) {
                $this->addError($attribute, 'Incorrect phone number');
            }
        }
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
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUserByPhoneNumber(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

    protected function getUserByPhoneNumber() {
        if ($this->_user === null) {
            $this->_user = User::findByPhoneNumber($this->phone_number);
        }

        return $this->_user;
    }
}
