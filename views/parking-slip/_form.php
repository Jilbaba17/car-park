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
    <?= $form->field($model, 'parking_slip_slotnumber')->textInput() ?>
    <?= $form->field($model, 'parking_slip_parkid')->textInput() ?>

    <?= $form->field($model, 'parking_slip_date')->widget(\kartik\date\DatePicker::className(), [
        'value' => date('Y-m-d'),
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd'
        ]
    ]) ?>
    <?= $form->field($model, 'parking_slip_datefrom')->widget(\kartik\datetime\DateTimePicker::className(), [
        'value' => date('Y-m-d H:i:s'),
        'pluginOptions' => [
            'convertFormat' => true,
            'format' => 'yyyy-mm-dd hh:ii:ss'
        ]
    ]); ?>

    <?= $form->field($model, 'parking_slip_dateto')->widget(\kartik\datetime\DateTimePicker::className(), [
        'value' => date('Y-m-d H:i:s'),
        'pluginOptions' => [
            'convertFormat' => true,
            'format' => 'yyyy-mm-dd hh:ii:ss'
        ]
    ]); ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
