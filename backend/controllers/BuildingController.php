<?php

namespace backend\controllers;

use Yii;
use common\models\Block;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\db\Query;
use common\controllers\MainController;
use common\models\Customer;
use yii\bootstrap\Html;

/**
 * BuildingController implements the CRUD actions for BuildingMaster model.
 */
class BuildingController extends MainController {
 

    /**
     * Lists all BuildingMaster models.
     * @return mixed
     */
    public function actionIndex() {
    	if(\Yii::$app->request->isAjax) {
    		\Yii::$app->response->format = Response::FORMAT_JSON;
    		$buildings = Block::find()
    		->asArray()
    		->all();
    		return ['data' => $buildings];
    		
    	}
    	
    	return $this->render('index');
    }

    /**
     * Displays a single BuildingMaster model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BuildingMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Block();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	if(! \Yii::$app->request->isAjax) {
        		\Yii::$app->session->setFlash('success', 'City added successfully');
        		return $this->redirect(['index']);
        	}
        	return json_encode(['msg' => 'Building saved successfully']);
        } 
        if(\Yii::$app->request->isAjax) {
        	return $this->renderAjax('create', [
        		'model' => $model,
        	]);
        }
       
        return $this->render('create', [
        	'model' => $model,
        ]);
       
    }
  

    /**
     * Updates an existing BuildingMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BuildingMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    
    public function actionDelete($id)
    {
    	if ($this->findModel($id)->delete()) {
    		\Yii::$app->session->setFlash('success', 'Building deleted successfully');
        }
    	
    	
    	
    	return $this->redirect(['index']);
    }
    

    /**
     * Finds the BuildingMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Block the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Block::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested building does not exist.');
        }
    }
}
