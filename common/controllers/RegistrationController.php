<?php

namespace common\controllers;

use dektrium\user\controllers\RegistrationController as BaseRegistrationController;
use common\models\RegistrationForm;
use dektrium\rbac\models\Assignment;
use app\models\User;

class RegistrationController extends BaseRegistrationController {
	
	public function init() {
		$this->on(self::EVENT_AFTER_REGISTER, [$this, 'addDefaultRole']);
	}
	
	/**
	 * Displays the registration page.
	 * After successful registration if enableConfirmation is enabled shows info message otherwise
	 * redirects to home page.
	 *
	 * @return string
	 * @throws \yii\web\HttpException
	 */
	public function actionRegister() {
		if (! $this->module->enableRegistration) {
			throw new NotFoundHttpException();
		}
		
		/** @var RegistrationForm $model */
		$model = \Yii::createObject(RegistrationForm::className());
		$event = $this->getFormEvent($model);
		
		$this->trigger(self::EVENT_BEFORE_REGISTER, $event);
		
		$this->performAjaxValidation($model);
		
		if ($model->load(\Yii::$app->request->post()) && $model->register()) {
			
			$this->trigger(self::EVENT_AFTER_REGISTER, $event);
			\Yii::$app->session->setFlash('success', 'Your account was created successfully! Please login');
			return $this->redirect(['//user/login']);
		}
		
		return $this->render('register', [
			'model' => $model,'module' => $this->module
		]);
	}
	
	public function addDefaultRole($event) {
		$user = $this->finder->findUserByEmail($event->form->email);
		
		//print_r($user); die;
		$auth = \Yii::$app->authManager;
		$userRole = $auth->getRole('USER');
		$auth->assign($userRole, $user->id);
	}
	
	
	
}