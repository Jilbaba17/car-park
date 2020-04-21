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
    public function actionAssign($tagid, $unassign = false) {
    	$model = $this->findModel($tagid);
    	if($unassign) {
    		$model->company = 0;
    		$model->employee_code = 0;
    		$model->car_model = '';
    		$model->car_regno = '';
    		$model->tagstatus = 0;
    		
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
    		if(! \Yii::$app->user->identity->role == 'SUPER_ADMIN') {
    			$rsTags->where('customer_id =' . \Yii::$app->user->identity->customer_id);
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
    public function actionUpdate($tagid) {
    	$model = $this->findModel($tagid);
    	
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
    public function actionDelete($tagid)
    {
    	$this->findModel($tagid)->delete();
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
    		$query->select(new Expression("id, CONCAT_WS(' ', firstName, lastName) AS name"))
    		->from(User::tableName())
    		->where('company_id=' . $parent);
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
    protected function findModel($id)
    {
    	if (($model = ParkingLot::findOne($id)) !== null) {
    		return $model;
    	} 
    	
    	throw new NotFoundHttpException('The requested tag does not exist.');
    }

}
