<?php

namespace backend\controllers;

use common\models\ParkingSlip;
use common\controllers\MainController;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;

class EntryController extends MainController
{
    
    public function actionRecordEntry($operation = 'checkIn') {
    	$model = new ParkingSlip();
        if (\Yii::$app->request->isAjax){

//    			return Json::encode(\yii\widgets\ActiveForm::validate($model));
            return Json::encode([]);
        }
    	if(\Yii::$app->request->isPost) {
    		$model->load(\Yii::$app->request->post());
            $result = false;
    		if($operation == ParkingSlip::SCENARIO_CHECKIN) {
                $result = $this->checkIn($model);
            }
    		if($operation == ParkingSlip::SCENARIO_CHECKOUT) {
                $result = $this->checkOut($model);

            }

    		if($result && $model->save(false)) {
    				
    			\Yii::$app->session->addFlash('success', "Vehicle ". $model->generateAttributeLabel($operation) . " successful");
    		} else {
                \Yii::$app->session->addFlash('danger', "Vehicle ". $model->generateAttributeLabel($operation) . " failed");

            }
    	}

    	$url = Url::to(['site/index', 'operation' => $operation]);
    	
    	return $this->redirect($url);
    }

    private function checkIn(ParkingSlip &$model) {
        $model->scenario = ParkingSlip::SCENARIO_CHECKIN;
        $model->status = 1;
        $model->intime = \Yii::$app->formatter->asDatetime(time(), 'php:Y-m-d h:i:s');
        if($model->validate()) {

            return true;
        }
        return false;

    }
    private function checkOut(ParkingSlip &$model) {
        $entry= $this->findTag($model->tagid);
        if($entry) {
            $model->scenario = ParkingSlip::SCENARIO_CHECKOUT;
            $model->id = $entry->id;
            $model->status = $entry->status;
            $model->intime = $entry->intime;
            $model->setIsNewRecord(false);
            $model->outtime = \Yii::$app->formatter->asDatetime(time(), 'php:Y-m-d h:i:s');
           // var_dump($model->attributes, $model->validate()); die;
            if (!$model->validate()) {
                return false;
            } 
            $model->status = 0;
            return true;
        }
        \Yii::$app->session->addFlash('warning', 'Vehicle has not been checked in');
        return false;

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
    	if (($entry = ParkingSlip::find()->where(['tagid' => $id])->orderBy(['intime' => SORT_DESC])->one()) !== null) {
    		//echo $invoiceModel->scenario;
    		
    		return $entry;
    	}
    	return null;
    }

}
