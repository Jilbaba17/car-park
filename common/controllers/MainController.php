<?php

namespace common\controllers;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class MainController extends Controller
{
    public function behaviors()
    {
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'except' => ['site/login'],
            'rules' => [
                [
                    'actions' => ['login', 'error'],
                    'allow' => true,
                ],
                [

                    'allow' => true, 'roles' => ['@'],
                    'matchCallback' => function ($rule, $action) {

                        $module = \Yii::$app->controller->module->id;
                        $action = \Yii::$app->controller->action->id;
                        $controller = \Yii::$app->controller->id;
                        $route = "$module/$controller/$action";
//						 var_dump( $action, $route); die;
                        //$post = Yii::$app->request->post();
                        if ("$controller/$action" == 'site/logout') {
                            return true;
                        }
                        if ($module == 'app-frontend') {
                            return true;
                        }
                        if ($module == 'app-backend') {
                            if (\Yii::$app->user->identity->role == 'SUPER_ADMIN') {
                                return true;
                            }
                            if (\Yii::$app->user->identity->role != 'SUPER_ADMIN' && "$controller/$action" == 'site/index') {
                                return true;
                            }
                            return false;

                        }
                    },
                ],
            ],

        ];
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'logout' => ['post'],
            ],
        ];

        return $behaviors;
    }
}