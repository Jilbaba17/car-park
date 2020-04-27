<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Payments */

$this->title = 'Update Payments: ' . $model->Payment_id;
$this->params['breadcrumbs'][] = ['label' => 'Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Payment_id, 'url' => ['view', 'id' => $model->Payment_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="payments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
