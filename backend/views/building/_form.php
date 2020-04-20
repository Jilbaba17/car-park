<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use nex\chosen\Chosen;
use yii\helpers\ArrayHelper;
use common\models\CityMaster;

/* @var $this yii\web\View */
/* @var $model common\models\Block */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="building-master-form">

    <?php $form = ActiveForm::begin([
    	'options' => [
    		'id' => 'create-update-form'
    	]
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city_code')->widget(Chosen::className(), [
    	'placeholder' => 'Select City',
    	'items' => ArrayHelper::map(CityMaster::find()->all(), 'id', 'name')
    ]) ?>

    <?= $form->field($model, 'tot_slots')->textInput() ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php 
if(isset($_GET['modal'])) {
	$js = <<<JS
	var form = jQuery('#create-update-form');
	$('body').on('submit', form, function(e) {
	    e.preventDefault();
		e.stopImmediatePropagation();
	    jQuery.ajax({
	        url: form.attr('action'),
	        type: form.attr('method'),
	        data: new FormData(form[0]),
	        mimeType: 'multipart/form-data',
	        contentType: false,
	        cache: false,
	        processData: false,
	        dataType: 'json',
	        success: function (data) {
	            alert(data.msg);
				//console.log(form);
				$(form)[0].reset();
	        }
	    });
	     return false;
	});
JS;
	$this->registerJs($js);
}
?>