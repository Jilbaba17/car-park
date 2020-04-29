<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Administrator */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="administrator-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'admin_loginid')->passwordInput() ?>

    <?= $form->field($model, 'admin_contact')->textInput() ?>

    <?= $form->field($model, 'admin_name')->textInput() ?>

    <?= $form->field($model, 'admin_emailaddress')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
