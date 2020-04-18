<?php

namespace backend\controllers;

use Yii;
use common\models\BuildingMaster;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\db\Query;
use common\controllers\MainController;
use common\models\Company;
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
    		$buildings = BuildingMaster::find()
    		->with('city')
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
        $model = new BuildingMaster();

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
     * 
     * @return string
     */
    public function actionCsvInfo() {
    	$content = '';
    	$content = Html::img(\Yii::$app->homeUrl . 'images/building-csv.jpg');
    	return $content;
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
            return $this->redirect(['view', 'id' => $model->id]);
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
    	if (Company::find()->where('city_code=:code', [':code' => $id])->exists()) {
    		\Yii::$app->session->setFlash('warning', 'Please dis-associate any companies with this buiding before deleting');
    		
    	} else {
    		$this->findModel($id)->delete();
    		\Yii::$app->session->setFlash('success', 'Building deleted successfully');
    	}
    	
    	
    	return $this->redirect(['index']);
    }
    /**
     * 
     * @param string $q
     * @param string $id
     * @return string
     */
    public function actionGetBuildings($q = null, $id = null) {
    	\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    	$out = ['results' => ['id' => '', 'text' => '']];
    	if (!is_null($q)) {
    		$query = new Query();
    		$query->select('id, name AS text')
    		->from(BuildingMaster::tableName())
    		->where(['OR', ['like', 'name', $q], ['like', 'address', $q]])
    		->limit(20);
    		$command = $query->createCommand();
    		$data = $command->queryAll();
    		$out['results'] = array_values($data);
    	}
    	elseif ($id > 0) {
    		$out['results'] = ['id' => $id, 'text' => BuildingMaster::find($id)->name];
    	}
    	return $out;
    }

    /**
     * Finds the BuildingMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BuildingMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BuildingMaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested building does not exist.');
        }
    }
}
