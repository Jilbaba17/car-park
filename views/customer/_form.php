<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model); ?>
    <?= $form->field($model, 'customer_contact')->textInput() ?>

    <?= $form->field($model, 'customer_regularornew')->dropDownList(\app\models\Customer::CUSTOMER_TYPE) ?>


    <?= $form->field($model, 'customer_loginid')->dropDownList(\app\models\Login::getCustomerLoginIds()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
