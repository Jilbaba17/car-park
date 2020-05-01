<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ParkingSlip */

$this->title = 'Update Parking Slip: ' . $model->parking_slip_id;
$this->params['breadcrumbs'][] = ['label' => 'Parking Slips', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->parking_slip_id, 'url' => ['view', 'id' => $model->parking_slip_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="parking-slip-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
