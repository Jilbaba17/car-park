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
    	$profile = new Profile();
    	//$profile->link('user', $model);
    	
    	$transaction = \Yii::$app->db->beginTransaction();
    	if(\Yii::$app->request->isPost) {
	    	try {
		    		$model->load(\Yii::$app->request->post());
		    		$model->generateUsername();
		    		$model->password_hash = $model->username;
		    		$profile->load(\Yii::$app->request->post());
		    		$model->setProfile($profile);
		    		$model->save();
// 		    		print_r($_POST);
// 		    		print_r($model->attributes);
// 		    		print_r($profile->attributes); die;
		    		//$model->link('profile', $profile);
		    		$transaction->commit();
		    		\Yii::$app->session->setFlash('success', 'User added successfully');
		    		if(\Yii::$app->user->can('SUPER_ADMIN')) {
		    			\Yii::$app->session->setFlash('info', 'Kindly select a role for the new user');
		    			return $this->redirect(['update', 'id' => $model->id]);
		    		}
		    		return $this->redirect(['index']);
		    	
	    	} catch(\Throwable $e) {
	    		$transaction->rollBack();
	    		throw $e;
	    	}
    	}
   		//print_r($model->attributes); die;
        return $this->render('create', [
        		'model' => $model,
        		'profile' => $profile,
        		//'assignment' => $assignment
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
    		->select(new Expression("id, CONCAT_WS(' ', firstName, lastName) AS names, phone_number, company_id"))
    		->with('profile');
    		if(\Yii::$app->user->can('SUPER_ADMIN')) {
    			$rsUsers->with(['company', 'profile']);
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
    	$model->role = key(ArrayHelper::getColumn(\Yii::$app->authManager->getRolesByUser($id), 'name'));
    	//print_r($model->role); die;
    	$profile = Profile::findOne($id);
    	
    	if ($model->load(\Yii::$app->request->post()) ) {
    		$profile->load(\Yii::$app->request->post());
    		//$model->setProfile($profile);
    		//print_r($profile->attributes); die;
    		$model->save();
    		$profile->save();
    		$assignment = new Assignment(['user_id' => $model->id]);
    		$assignment->items[] = $model->role;
    		$assignment->updateAssignments();
    		\Yii::$app->session->setFlash('success', 'User updated successfully');
    		return $this->redirect(['index']);
    	}
    	
    	return $this->render('update', [
    			'model' => $model,
    			'profile' => $profile,
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
