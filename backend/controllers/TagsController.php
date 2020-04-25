<?php

namespace backend\controllers;

use common\models\ParkingLot;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\db\Expression;
use common\models\User;
use yii\db\Query;

class TagsController extends \yii\web\Controller
{
    public function actionAssign($park_tagid, $unassign = false) {
    	$model = $this->findModel($park_tagid);
    	if($unassign) {
    		$model->park_customer_id = null;
    		$model->park_employee_code = null;
    		$model->park_car_model = '';
    		$model->park_car_regno = '';
    		$model->park_tagstatus = 0;
    		
    		if($model->save()) {
    			
    			\Yii::$app->session->setFlash('success', 'The tag was un-assigned successfully');
    		} else {
    			\Yii::$app->session->setFlash('danger', 'An error occurred while assigning the tag, please try again or contact the administrator');
    			
    		}
    		return $this->redirect(['index']);
    		
    	}
    	$model->scenario = 'assign';
    	if ($model->load(\Yii::$app->request->post()) && $model->save()) {
    		\Yii::$app->session->setFlash('success', 'Tag assigned successfully');
    		return $this->redirect(['index']);
    		
    	}
        return $this->render('assign', [
        		'model' => $model
        ]);
    }


    public function actionIndex()
    {
    	if(\Yii::$app->request->isAjax) {
    		\Yii::$app->response->format = Response::FORMAT_JSON;
    		$rsTags = ParkingLot::find()
    		->with(['user', 'customer']);
    		if(! \Yii::$app->user->identity->user_role == 'SUPER_ADMIN') {
    			$rsTags->where('park_customer_id =' . \Yii::$app->user->identity->customer_id);
    		}
    		$tags = $rsTags->asArray()->all();
    		return [
    			'data' => $tags
    		];
    	}
        return $this->render('index');
    }

    /**
     * Creates a new TagMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
    	$model = new ParkingLot();
    	
    	if ($model->load(\Yii::$app->request->post()) && $model->save()) {
    		\Yii::$app->session->setFlash('success', 'Slot added successfully');
    		return $this->redirect(['index']);
    		
    	}
    	
    	return $this->render('create', [
    		'model' => $model,
    	]);
    }
    
    /**
     * Updates an existing TagMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($user_id) {
    	$model = $this->findModel($user_id);
    	
    	if ($model->load(\Yii::$app->request->post()) && $model->save()) {
    		\Yii::$app->session->setFlash('success', 'Slot updated successfully');
    		
    		return $this->redirect(['index']);
    	}
    	return $this->render('update', [
    		'model' => $model,
    	]);
    	
    }
    
    /**
     * Deletes an existing TagMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($park_tagid)
    {
    	$this->findModel($park_tagid)->delete();
    	\Yii::$app->session->setFlash('success', 'Slot deleted successfully');
    	
    	return $this->redirect(['index']);
    }
    
    /**
     *
     * @param string $q
     * @param string $id
     * @return string
     */
    public function actionGetEmployees() {
    	\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    	$out = [];
    	if (\Yii::$app->request->isPost) {
    		$parent =  $_POST['depdrop_parents'][0];
    		$query = new Query();
    		$query->select(new Expression("user_id, CONCAT_WS(' ', user_firstName, user_lastName) AS name"))
    		->from(User::tableName())
    		->where('user_customer_id=' . $parent);
    		//}
    		$command = $query->createCommand();
    		$data = $command->queryAll();
    		$out = array_values($data);
    	}
    	
    	return ['output' => $out, 'selected' => ''];
    }
    
    
    
    /**
     * Finds the TagMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ParkingLot the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id)
    {
    	if (($model = ParkingLot::findOne($user_id)) !== null) {
    		return $model;
    	} 
    	
    	throw new NotFoundHttpException('The requested tag does not exist.');
    }

}
