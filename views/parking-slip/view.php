<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ParkingSlip */

$this->title = $model->parking_slip_id;
$this->params['breadcrumbs'][] = ['label' => 'Parking Slips', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="parking-slip-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->parking_slip_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->parking_slip_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'parking_slip_id',
            'parking_slip_customerid',
            'parking_slip_carplatenumber',
            'parking_slip_carcolor',
            'parking_slip_datefrom',
            'parking_slip_date',
            'parking_slip_slotnumber',
            'parking_slip_dateto',
            'parking_slip_parkid',
        ],
    ]) ?>

</div>
