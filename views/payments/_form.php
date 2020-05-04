<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Payments */
/* @var $form yii\widgets\ActiveForm */
/* @var $unpaidSlips array */
?>

<div class="payments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'payment_parking_slip_id')->dropDownList($unpaidSlips)->label('Vehicle') ?>
    <?= $form->field($model, 'payment_date')->widget(\kartik\datetime\DateTimePicker::className(), [
        'value' => date('Y-m-d H:i:s'),
        'options' => [
            'placeholder' => date('Y-m-d H:i:s')
        ],
        'pluginOptions' => [
            'convertFormat' => true,
            'format' => 'yyyy-mm-dd hh:ii:ss'
        ]
    ]) ?>

    <?= $form->field($model, 'payment_mode')->dropDownList(\app\models\Payments::PAYMENT_MODES) ?>

    <?= $form->field($model, 'payment_reference')->textInput(['placeholder' => 'none']) ?>

    <?= $form->field($model, 'payment_amount')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
