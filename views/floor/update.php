<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Floor */

$this->title = 'Update Floor: ' . $model->floor_id;
$this->params['breadcrumbs'][] = ['label' => 'Floors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->floor_id, 'url' => ['view', 'id' => $model->floor_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="floor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
