<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Payments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Payment_id')->textInput() ?>

    <?= $form->field($model, 'Payment_mode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Payment_reference')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Payment_Parking slip id')->textInput() ?>

    <?= $form->field($model, 'Payment_amount')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
