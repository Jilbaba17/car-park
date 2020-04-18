<?php

namespace common\controllers;
use yii\filters\AccessControl;
use yii\web\Controller;

class MainController extends Controller {
	public function behaviors() {
		$behaviors['access'] = [
			'class' => AccessControl::className(),
			'except' => ['site/login'],
			'rules' => [

				[
					'allow' => true, 'roles' => [
						'@',
					],
					'matchCallback' => function ($rule, $action) {

						$module = \Yii::$app->controller->module->id;
						$action = \Yii::$app->controller->action->id;
						$controller = \Yii::$app->controller->id;
						$route = "$module/$controller/$action";
						// echo $route;die;
						//$post = Yii::$app->request->post();
						if (\Yii::$app->user->can($route)) {
							return true;
						}
					},
				],
			],
		];

		return $behaviors;
	}
}