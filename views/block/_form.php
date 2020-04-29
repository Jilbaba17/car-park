<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Block */
/* @var $form yii\widgets\ActiveForm */


$floors = \yii\helpers\ArrayHelper::map(\app\models\Floor::find()
    ->select('floor_id', 'floor_number')->asArray()->all(), 'floor_id', 'floor_number');
?>

<div class="block-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'block_floorid')->dropDownList($floors) ?>

    <?= $form->field($model, 'block_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'block_capacity')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
