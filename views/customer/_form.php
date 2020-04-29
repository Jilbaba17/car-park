<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_contact')->textInput() ?>

    <?= $form->field($model, 'customer_regularornew')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_registrationdate')->textInput() ?>

    <?= $form->field($model, 'customer_loginid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
