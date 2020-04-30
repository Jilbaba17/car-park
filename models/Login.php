<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "login".
 *
 * @property int $login_id
 * @property int $login_code
 * @property string $login_rank
 */
class Login extends \yii\db\ActiveRecord implements IdentityInterface
{
    const ROLES = [
        'USER' => 'USER',
        'ADMIN' => 'ADMIN'
    ];

    public $role;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'login';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login_code', 'login_rank'], 'required'],
            [['login_code'], 'integer'],
            [['login_code'], 'unique'],
            [['login_rank'], 'string', 'max' => 100],
            [['role'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'login_id' => 'Login ID',
            'login_code' => 'Login Code',
            'login_rank' => 'Login Rank',
        ];
    }

    public function getAdmin() {
        return $this->hasOne(Administrator::className(), ['admin_loginid' => 'login_id']);
    }
    public function getCustomer() {
        return $this->hasOne(Customer::className(), ['customer_loginid' => 'login_id']);
    }

    public static function getAdminLoginIds() {
        return ArrayHelper::map(self::find()
            ->select('login_id, login_code')
            ->where("login_rank='ADMIN'")
            ->asArray()->all(), 'login_id', 'login_code');
    }
    public static function getCustomerLoginIds() {
        return ArrayHelper::map(self::find()
            ->select('login_id, login_code')
            ->where("login_rank='USER'")
            ->asArray()->all(), 'login_id', 'login_code');
    }



    public static function findIdentity($id)
    {
        return static::findOne(['login_id' => $id]);
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
    public static function findByLoginCode($loginCode)
    {
        $user = Login::find()->where('login_code=:code', [':code' => $loginCode])->one();
        if ($user) {
            if($user)
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
        return $this->login_id;
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
     * @param string $loginCode password to validate
     * @return bool if password provided is valid for current user
     */
    public function validateLoginCode($loginCode)
    {
        return $this->login_code === (int) $loginCode;
    }


}
