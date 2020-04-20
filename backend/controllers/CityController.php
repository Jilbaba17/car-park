<?php

namespace backend\controllers;

use Yii;
use common\models\CityMaster;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\db\Query;
use common\controllers\MainController;
use common\models\Block;
use common\models\Customer;
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;

/**
 * CityController implements the CRUD actions for CityMaster model.
 */
class CityController extends MainController {
    

    /**
     * Lists all CityMaster models.
     * @return mixed
     */
    public function actionIndex() {
    	if(\Yii::$app->request->isAjax) {
    		\Yii::$app->response->format = Response::FORMAT_JSON;
    		$cities = CityMaster::find()->asArray()->all();
    		return ['data' => $cities];
    		
    	}

        return $this->render('index');
    }

    /**
     * Displays a single CityMaster model.
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
     * Creates a new CityMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new CityMaster();
        if ($model->load(Yii::$app->request->post())) {
        	if(\Yii::$app->request->isAjax) {
        		\Yii::$app->response->format = Response::FORMAT_JSON;
        		return ActiveForm::validate($model);
        	}
        	if(! \Yii::$app->request->isAjax  && $model->save()) {
        		\Yii::$app->session->setFlash('success', 'City added successfully');
        		return $this->redirect(['index']);
        	}
        	return json_encode(['msg' => 'City saved successfully']);
        	
        	
        } 
        if (Yii::$app->request->isAjax) {
        	
        	return $this->renderAjax('_form', [
        		'model' => $model
        	]);
        }
        return $this->render('create', [
        	'model' => $model,
        ]);
    }
    
    public function actionCsvInfo() {
    	$content = '';
    	$content = Html::img(\Yii::$app->homeUrl . 'images/city-csv.jpg');
    	return $content;
    }
    

    /**
     * Updates an existing CityMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
        	if(\Yii::$app->request->isAjax) {
        		\Yii::$app->response->format = Response::FORMAT_JSON;
        		return ActiveForm::validate($model);
        	}
        	$model->save();
        	\Yii::$app->session->setFlash('success', 'City updated successfully');
        	
            return $this->redirect(['index']);
        } 
        return $this->render('update', [
        	'model' => $model,
        ]);
        
    }

    /**
     * Deletes an existing CityMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	if(Block::find()->where('city_code=:code', [':code' => $id])->exists()) {
    		\Yii::$app->session->setFlash('warning', 'Please dis-associate any buildings with this city before deleting');
    		
    	} elseif (Customer::find()->where('city_code=:code', [':code' => $id])->exists()) {
    		\Yii::$app->session->setFlash('warning', 'Please dis-associate any companies with this city before deleting');
    		
    	} else {
    		$this->findModel($id)->delete();
    		\Yii::$app->session->setFlash('success', 'City deleted successfully');
    	}
       
        
        return $this->redirect(['index']);
    }
    
    /**
     * 
     * @param string $q
     * @param string $id
     * @return string
     */
    public function actionGetCities($q = null, $id = null) {
    	\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    	$out = ['results' => ['id' => '', 'text' => '']];
    	if (!is_null($q)) {
    		$query = new Query();
    		$query->select('id, name AS text')
    		->from(CityMaster::tableName())
    		->where(['like', 'name', $q])
    		->limit(20);
    		$command = $query->createCommand();
    		$data = $command->queryAll();
    		$out['results'] = array_values($data);
    	}
    	elseif ($id > 0) {
    		$out['results'] = ['id' => $id, 'text' => CityMaster::find($id)->name];
    	}
    	return $out;
    }

    /**
     * Finds the CityMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CityMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CityMaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested city does not exist.');
        }
    }
}
