<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ParkingSlip */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parking-slip-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parking_slip_customerid')->textInput() ?>

    <?= $form->field($model, 'parking_slip_carplatenumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parking_slip_carcolor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parking_slip_datefrom')->textInput() ?>

    <?= $form->field($model, 'parking_slip_date')->textInput() ?>

    <?= $form->field($model, 'parking_slip_slotnumber')->textInput() ?>

    <?= $form->field($model, 'parking_slip_dateto')->textInput() ?>

    <?= $form->field($model, 'parking_slip_parkid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
