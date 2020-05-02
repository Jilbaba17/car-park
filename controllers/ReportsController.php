<?php

namespace app\controllers;

use app\models\Administrator;
use app\models\Block;
use app\models\Customer;
use app\models\Floor;
use app\models\ParkingLot;
use app\models\ParkingSlip;
use app\models\Payments;
use yii\data\ActiveDataProvider;

class ReportsController extends BaseAdminController
{
    public function actionAdministrator()
    {
        $query = Administrator::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('administrator', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionBlocks()
    {
        $query = Block::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('blocks', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCustomer()
    {
        $query = Customer::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('customer', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionFloors()
    {
        $query = Floor::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('floors', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionParkingLots()
    {
        $query = ParkingLot::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('parking-lots', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionParkingSlips()
    {
        $query = ParkingSlip::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('parking-slips', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionPayments()
    {
        $query = Payments::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('payments', [
            'dataProvider' => $dataProvider
        ]);
    }

}
