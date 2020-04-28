<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "login".
 *
 * @property int $login_id
 * @property int $login_code
 * @property string $login_rank
 */
class Login extends \yii\db\ActiveRecord
{
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
            [['login_id', 'login_code', 'login_rank'], 'required'],
            [['login_id', 'login_code'], 'integer'],
            [['login_rank'], 'string', 'max' => 100],
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
}
