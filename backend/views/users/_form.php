<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;
use kartik\widgets\Select2;
use common\models\Block;
use common\models\CityMaster;
use yii\web\JsExpression;
use common\models\Customer;
use dektrium\rbac\models\AuthItem;

/**
 * @var $model common\models\Customer
 * @var $this yii\web\View 
 */
$this->params['breadcrumbs'][] = $this->title;
$form = ActiveForm::begin([
	'id' => 'user-form',
	'enableClientValidation' => true
]);
?>

<div class="row">

	<div class="box box-primary">
		
		<div class="box-body">
		<?php 
		$buildingDesc = empty($model->company_id) ? '' : Customer::findOne($model->company_id)->name;
// 		$cityDesc = empty($model->city_code) ? '' : CityMaster::findOne($model->city_code)->name;
		
		echo $form->field($model, 'firstName');
		echo $form->field($model, 'lastName');
		echo $form->field($model, 'email');
		
		echo $form->field($model, 'phone_number');
			if(Yii::$app->user->can('SUPER_ADMIN')) {
				echo $form->field($model, 'company_id')->widget(Select2::className(), [
						'initValueText' => $buildingDesc, // set the initial display text
						'options' => ['placeholder' => 'Search for company ...'],
						'pluginOptions' => [
								'allowClear' => true,
								'minimumInputLength' => 3,
								'language' => [
										'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
								],
								'ajax' => [
										'url' => Url::to(['company/get-companies']),
										'dataType' => 'json',
										'data' => new JsExpression('function(params) { return {q:params.term}; }')
								],
								
						],
				]);
			} else {
				echo $form->field($model, 'company_id')->hiddenInput(['value' => Yii::$app->user->identity->company_id])->label(false);
			}
		if(!$model->isNewRecord) {
		
			if(Yii::$app->user->can('SUPER_ADMIN')) {
				$items = [
						'SUPER_ADMIN' => 'SUPER ADMIN',
						'COMPANY_ADMIN' => 'COMPANY ADMIN',
						'GUARD' => 'GUARD',
						'USER' => 'USER'
				];
				echo $form->field($model, 'role')->dropDownList(array_reverse($items, true));
			} 
		}
		
		echo $form->field($profile, 'department');
		echo $form->field($profile, 'gender')->dropDownList(["Male" => "Male", "Female" => "Female"]);
		
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
