<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BuildingMaster */

$this->title = 'Update Building ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Building ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="building-master-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
