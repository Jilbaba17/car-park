<?php
namespace backend\controllers;

use backend\models\ContactForm;
use yii\db\Expression;
use common\models\User;
use yii\db\Query;
use common\controllers\MainController;

class MessageController extends MainController {
	
	public function actionIndex() {
		$model = new ContactForm();
		$model->email = isset(\Yii::$app->user->identity->email) ? \Yii::$app->user->identity->email : null;
		if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
			if ($model->sendEmail()) {
				\Yii::$app->session->setFlash('success', 'Your message has been sent successfully.');
			} else {
				\Yii::$app->session->setFlash('error', 'There was an error sending your message.');
			}
			
			return $this->refresh();
		} 
		return $this->render('contact', [
				'model' => $model,
		]);
		
	}
	
	public function actionGetEmails($q = null, $id = null) {
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$out = ['results' => ['id' => '', 'text' => '']];
		if (!is_null($q)) {
			$query = new Query();
			$query->select(new Expression("CONCAT_WS(', ', CONCAT_WS(' ', firstName, lastName), email) as text, email as id"))
			->from(User::tableName())
			->where(['OR', ['like', 'firstName', $q], ['like', 'lastName', $q], ['like', 'email', $q]])
			->limit(20);
			$command = $query->createCommand();
			$data = $command->queryAll();
			$out['results'] = array_values($data);
		}
		elseif ($id > 0) {
			$out['results'] = ['id' => $id, 'text' => User::find()->where('email=' . $id)->one()];
		}
		return $out;
	}
}