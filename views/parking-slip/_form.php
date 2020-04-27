<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ParkingSlip */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parking-slip-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tagid')->textInput() ?>

    <?= $form->field($model, 'intime')->textInput() ?>

    <?= $form->field($model, 'outtime')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
