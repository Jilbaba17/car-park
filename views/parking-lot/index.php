<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Parking Lots';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parking-lot-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Parking Lot', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'tagid',
            'employee_code',
            'customer_id',
            'car_model',
            'car_regno',
            //'tagstatus',
            //'created_on',
            //'doissue',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
