<?php

namespace app\controllers;

use app\models\ParkingSlip;
use Yii;
use app\models\Payments;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaymentsController implements the CRUD actions for Payments model.
 */
class PaymentsController extends BaseAdminController
{

    /**
     * Lists all Payments models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Payments::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Payments model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Creates a new Payments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Payments();
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $slip = ParkingSlip::findOne($model->payment_parking_slip_id);
                $slip->parking_slip_dateto = date('Y-m-d H:i:s');
                $slip->save();
                Yii::$app->session->setFlash('success', 'Payment processed successfully');
                return $this->redirect(['view', 'id' => $model->payment_id]);
            }
            Yii::$app->session->setFlash('danger', 'An error occurred while processing payment');
        }
        $unPaidSlips = ParkingSlip::find()
            ->select('parking_slip_id, parking_slip_carplatenumber')
            ->where('parking_slip_dateto IS NULL')
            ->asArray()
            ->all();
        if (count($unPaidSlips) > 0) {
            $unPaidSlips = ArrayHelper::map($unPaidSlips, 'parking_slip_id', 'parking_slip_carplatenumber');
        }

        return $this->render('create', [
            'model' => $model,
            'unpaidSlips' => $unPaidSlips
        ]);
    }




    /**
     * Updates an existing Payments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->payment_id]);
        }
        $unPaidSlips = ParkingSlip::find()
            ->select('parking_slip_id, parking_slip_carplatenumber')
            ->where('parking_slip_dateto IS NULL')
            ->asArray()
            ->all();
        if (count($unPaidSlips) > 0) {
            $unPaidSlips = ArrayHelper::map($unPaidSlips, 'parking_slip_id', 'parking_slip_carplatenumber');
        }

        return $this->render('update', [
            'model' => $model,
            'unpaidSlips' => $unPaidSlips
        ]);
    }

    /**
     * Deletes an existing Payments model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Payments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Payments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Payments::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
