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

            'park_id',
            'park_code',
            'park_blockid',
            'park_valetparking',
            'park_slotnumberfrom',
            //'park_slotnumberto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
