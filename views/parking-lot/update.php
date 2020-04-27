<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ParkingLot */

$this->title = 'Update Parking Lot: ' . $model->tagid;
$this->params['breadcrumbs'][] = ['label' => 'Parking Lots', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tagid, 'url' => ['view', 'id' => $model->tagid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="parking-lot-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
