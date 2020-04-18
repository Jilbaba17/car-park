<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
	public $to;
	public $email;
    public $subject;
    public $body;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['to', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            [['email', 'to'], 'email'],
        	[['email', 'to'], 'exist', 'targetClass' => User::className(), 'targetAttribute' => 'email'],
            // verifyCode needs to be entered correctly
            //['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail()
    {
    	
        return Yii::$app->mailer->compose()
            ->setTo($this->to)
            ->setFrom($this->email)
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
}
