<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ParkingLot */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parking-lot-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'park_code')->textInput() ?>

    <?= $form->field($model, 'park_blockid')->textInput() ?>

    <?= $form->field($model, 'park_valetparking')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'park_slotnumberfrom')->textInput() ?>

    <?= $form->field($model, 'park_slotnumberto')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
