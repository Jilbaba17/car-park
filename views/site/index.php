<?php

/* @var $this yii\web\View */
/* @var $model \app\models\CheckinForm */
/* @var $floors array */

$this->title = 'Home';
?>
<div class="site-index">
    <?php $form = \yii\bootstrap\ActiveForm::begin(); ?>

    <div class="body-content">

        <div class="row">
            <?= $form->field($model, 'parking_slip_carplatenumber') ?>
            <?= $form->field($model, 'parking_slip_carcolor') ?>
            <?= $form->field($model, 'floor')
                ->dropDownList($floors, ['id' => 'floor', 'class' => 'chosen'])->label('Select Floor'); ?>
            <?= $form->field($model, 'park_blockid')->widget(\kartik\depdrop\DepDrop::classname(), [
                'options' => ['id' => 'park_blockid'],
                'pluginOptions' => [
                    'initialize' => true,
                    'depends' => ['floor'],
                    'placeholder' => 'Select...',
                    'allParam' => 'CheckinForm',
                    'url' => \yii\helpers\Url::to(['/site/get-block'])
                ]
            ])->label('Block'); ?>


            <?= $form->field($model, 'parking_slip_parkid')->widget(\kartik\depdrop\DepDrop::classname(), [
                'pluginOptions' => [
                    'initialize' => true,
                    'allParam' => 'CheckinForm',
                    'depends' => ['park_blockid'],
                    'placeholder' => 'Select...',
                    'url' => \yii\helpers\Url::to(['/site/get-slot'])
                ]
            ])->label('Parking Slot'); ?>

            <?= $form->field($model, 'parking_slip_slotnumber')->widget(\kartik\depdrop\DepDrop::classname(), [
                'pluginOptions' => [
                    'initialize' => true,
                    'allParam' => 'CheckinForm',
                    'depends' => ['park_blockid'],
                    'placeholder' => 'Select...',
                    'url' => \yii\helpers\Url::to(['/site/get-slot', 'slotNum' => 1])
                ]
            ])->label('Parking Slot Number'); ?>
            <?= \yii\bootstrap\Html::submitButton('Save'); ?>

        </div>

    </div>


</div>
<?php \yii\bootstrap\ActiveForm::end(); ?>
</div>
