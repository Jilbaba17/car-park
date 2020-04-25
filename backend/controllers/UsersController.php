<?php

namespace backend\controllers;

use common\models\User;
use yii\db\Expression;
use yii\web\Response;
use common\models\Profile;
use dektrium\rbac\models\Assignment;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use common\controllers\MainController;

class UsersController extends MainController
{
    public function actionCreate()
    {
    	$model = new User();

    	if(\Yii::$app->request->isPost) {
	    	try {
		    		$model->load(\Yii::$app->request->post());
		    		$model->password_hash = \Yii::$app->security->generatePasswordHash(\Yii::$app->security->generateRandomString());
		    		$model->save();
		    		\Yii::$app->session->setFlash('success', 'User added successfully');
		    		return $this->redirect(['index']);
		    	
	    	} catch(\Throwable $e) {
	    		\Yii::error('danger', $e->getMessage());
                \Yii::$app->session->setFlash('danger', 'User was not added successfully');
	    	}
    	}
   		//print_r($model->attributes); die;
        return $this->render('create', [
        		'model' => $model,
        ]);
    }
	
    public function actionDelete($id)
    {
    	$this->findModel($id)->delete();
    	\Yii::$app->session->setFlash('success', 'User deleted successfully');
        return $this->redirect(['index']);
    }

    public function actionIndex()
    {
    	if(\Yii::$app->request->isAjax) {
    		\Yii::$app->response->format = Response::FORMAT_JSON;
    		$rsUsers = User::find()
    		->select(new Expression("id, CONCAT_WS(' ', user_firstName, user_lastName) AS names, user_phone_number, user_customer_id"));
    		if(\Yii::$app->user->identity->user_role == 'SUPER_ADMIN') {
    			$rsUsers->with(['customer']);
    		}
    		$users = $rsUsers->asArray()->all();
    		return [
    				'data' => $users
    		];
    	}
    	
    	return $this->render('index');
    }

    public function actionUpdate($id)
    {
    	$model = $this->findModel($id);
    	$model->user_role = User::ROLES;
    	//print_r($model->role); die;

    	if ($model->load(\Yii::$app->request->post()) ) {
    		$model->save();
    		if(!empty($model->password_hash)) {
                $model->password_hash = \Yii::$app->security->generatePasswordHash($model->password_hash);
            }

            \Yii::$app->session->setFlash('success', 'User updated successfully');
    		return $this->redirect(['index']);
    	}
    	
    	return $this->render('update', [
    			'model' => $model,
    	]);
    }
    
    
    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
    	if (($model = User::findOne($id)) !== null) {
    		return $model;
    	} 
    	throw new NotFoundHttpException('The requested user does not exist.');
    }

}
