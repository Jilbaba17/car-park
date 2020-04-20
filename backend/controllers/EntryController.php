<?php

namespace backend\controllers;

use common\models\ParkingSlip;
use common\controllers\MainController;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;

class EntryController extends MainController
{
    
    public function actionRecordEntry($operation = 'checkIn') {
    	$model = new ParkingSlip();
    	
    	if(\Yii::$app->request->isPost) {
    		$model->load(\Yii::$app->request->post());
    		$model->scenario = ParkingSlip::SCENARIO_CHECKIN;
    		$model->intime = \Yii::$app->formatter->asDatetime(time(), 'php:Y-m-d h:i:s');
    		$entry= $this->findTag($model->tagid);
    		if(isset($entry)) {
    			$model->setIsNewRecord(false);
    			$model->status = $entry->status;
    			//print_r($entry); die;
    		}
    			
    		if($operation == ParkingSlip::SCENARIO_CHECKOUT) {
    			$model->scenario = ParkingSlip::SCENARIO_CHECKOUT;
    			$model->outtime = \Yii::$app->formatter->asDatetime(time(), 'php:Y-m-d h:i:s');
    			unset($model->intime);
    		}
    		if (\Yii::$app->request->isAjax){
    			return json_encode(\yii\widgets\ActiveForm::validate($model));
    		}
    		if($model->validate()) {
    			$model->status = 1;
    			if($model->scenario == ParkingSlip::SCENARIO_CHECKOUT) {
    				$model->status = 0;
    				
    			}
    			//var_dump($model); die;
    			$model->save(false);
    				
    			\Yii::$app->session->setFlash('success', "Vehicle ". $model->generateAttributeLabel($operation) . " successful", false);
    		}
    	}
    	// Build company map and send it to view
    	//     	$companyMap = ArrayHelper::map(Company::find()
    	//     			->select('cid, name')
    	//     			->asArray()
    	//     			->all(), 'cid', 'name');
    	
    	$url = Url::to(['site/index', 'operation' => $operation]);
    	
    	//echo $url; die;
    	return $this->redirect($url);
    	//     	return $this->render('index', [
    	//     		'model' => $model,
    	//     		'companyMap' => $companyMap
    	//     	]);
    	
    }
    
    /**
     * Finds the Entry model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ParkingSlip the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
    	//$model = new Invoices();
    	//$model->setScenario(Invoices::SCENARIO_UPDATE);
    	//$invoiceModel = $model->find()->where('invoiceId=:id', [':id' => $id]);
    	if (($entry = ParkingSlip::findOne($id)) !== null) {
    		//echo $invoiceModel->scenario;
    		
    		return $entry;
    	}
    	throw new NotFoundHttpException('The requested tag does not exist.');
    	
    }
    /**
     * 
     * @param unknown $id
     * @return \common\models\ParkingSlip|NULL
     */
    protected function findTag($id) {
    	if (($entry = ParkingSlip::findOne($id)) !== null) {
    		//echo $invoiceModel->scenario;
    		
    		return $entry;
    	}
    	return null;
    }

}
