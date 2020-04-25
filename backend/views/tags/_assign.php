<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;
use kartik\widgets\Select2;
use common\models\Block;
use yii\web\JsExpression;
use kartik\widgets\DepDrop;

/**
 * @var $model common\models\Customer
 * @var $this yii\web\View 
 */
$this->params['breadcrumbs'][] = $this->title;
$form = ActiveForm::begin([
	'id' => 'tags-form'
]);
?>

<div class="row">

	<div class="box box-primary">
		
		<div class="box-header with-border">
			<h3 class="box-title invisible"><?= $this->title ?></h3>
			<div class="box-tools pull-right">
		
			
			</div>
			</div>
		
		<div class="box-body">
		<?php 
		
		
		echo $form->field($model, 'park_tagid');
		
		if(Yii::$app->user->identity->user_role == 'SUPER_ADMIN') {
			echo $form->field($model, 'park_customer_id')->widget(Select2::className(), [
					'initValueText' => '', // set the initial display text
					'options' => ['id' => 'park_customer_id', 'placeholder' => 'Search for customer...'],
					'pluginOptions' => [
							'allowClear' => true,
							'minimumInputLength' => 3,
							'language' => [
									'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
							],
							'ajax' => [
									'url' => Url::to(['company/get-companies']),
									'dataType' => 'json',
									//'data' => new JsExpression('function(params) { return {q:params.term}; }')
							],
							
					],
			]);
		} else {
			echo $form->field($model, 'park_customer_id')->hiddenInput([
					'id' => 'customer_id',
					'value' => Yii::$app->user->identity->user_customer_id
			])->label(false);
		}
		echo $form->field($model, 'park_employee_code')->widget(DepDrop::className(), [
				'options'=> ['id'=>'park_employee_code'],
				'pluginOptions'=>[
						'initialize'=> false,
						'depends'=>['park_customer_id'],
						'placeholder'=>' -- Select employee -- ',
						'url'=> Url::to(['tags/get-employees']),
						'params' => ['park_customer_id']
				]
		]);
		echo $form->field($model, 'park_car_model');
		echo $form->field($model, 'park_car_regno');
		echo $form->field($model, 'park_tagstatus')->dropDownList([
				1 => 'Active',
				0 => 'Inactive'
		]);
		
		
		
		?>
		</div>
		
		<div class="box-footer">
		<?=
		Html::button('Save', [
			'class' => 'btn btn-success',
			'type' => 'submit'
		]);
		
		?>
		</div>
		<?php  ActiveForm::end(); ?>
	</div>
</div>
<?php
$js = <<<JS
$('#park_customer_id').trigger('depdrop:change');
JS;
$this->registerJs($js);
$this->registerJsFile(Yii::$app->homeUrl . 'js/ajax-modal-popup.js', ['depends' => 'yii\web\jQueryAsset']);

?>
