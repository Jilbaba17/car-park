<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Parking Slips';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parking-slip-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Parking Slip', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'parking_slip_id',
            'parking_slip_customerid',
            'parking_slip_carplatenumber',
            'parking_slip_carcolor',
            'parking_slip_datefrom',
            //'parking_slip_date',
            //'parking_slip_slotnumber',
            'parking_slip_dateto',
            //'parking_slip_parkid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
