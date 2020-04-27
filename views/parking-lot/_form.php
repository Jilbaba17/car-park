<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ParkingLot */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parking-lot-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tagid')->textInput() ?>

    <?= $form->field($model, 'employee_code')->textInput() ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'car_model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'car_regno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tagstatus')->textInput() ?>

    <?= $form->field($model, 'created_on')->textInput() ?>

    <?= $form->field($model, 'doissue')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
