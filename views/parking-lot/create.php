<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ParkingLot */

$this->title = 'Create Parking Lot';
$this->params['breadcrumbs'][] = ['label' => 'Parking Lots', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parking-lot-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
