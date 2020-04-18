<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\helpers\Url;

$this->title = 'Send Mail';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-contact">

    <p>
        If you have inquiries or other questions, please fill out the following form to send it to the appropriate person. Thank you.
    </p>

    <div class="row">
        <div class="box box-primary">
		
		<div class="box-header with-border">
			<h3 class="box-title"> Compose New Message</h3>
		</div>
		
		<div class="box-body">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?=
                $form->field($model, 'to')->widget(Select2::className(), [
                		'initValueText' => '', // set the initial display text
                		'options' => ['placeholder' => 'Search for contact ...'],
                		'pluginOptions' => [
                				'allowClear' => true,
                				'minimumInputLength' => 3,
                				'language' => [
                						'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                				],
                				'ajax' => [
                						'url' => Url::to(['message/get-emails']),
                						'dataType' => 'json',
                						'data' => new JsExpression('function(params) { return {q:params.term}; }')
                				],
//                 				'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
//                 				'templateResult' => new JsExpression('function(city) { return city.text; }'),
//                 				'templateSelection' => new JsExpression('function (city) { return city.text; }'),
                		],
                ]);
                ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                <?php // $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                   // 'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                //]) ?>
				</div>
				
                <div class="box-footer">
                    <?= Html::submitButton('Send', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
