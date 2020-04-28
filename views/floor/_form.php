<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Floor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="floor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'floor_id')->textInput() ?>

    <?= $form->field($model, 'floor_number')->textInput() ?>

    <?= $form->field($model, 'floor_maxheight')->textInput() ?>

    <?= $form->field($model, 'floor_numberofblocks')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
