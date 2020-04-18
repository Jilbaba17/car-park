<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;
use kartik\widgets\Select2;
use common\models\BuildingMaster;
use common\models\CityMaster;
use yii\web\JsExpression;

/**
 * @var $model common\models\Company
 * @var $this yii\web\View 
 */
$this->params['breadcrumbs'][] = $this->title;
$form = ActiveForm::begin([
	'id' => 'company-form'
]);
?>

<div class="row">

	<div class="box box-primary">
		
		<div class="box-header with-border">
			<h3 class="box-title invisible"> Add Company</h3>
			<div class="box-tools pull-right">
		
			<?=
			Html::button('Add City', [
				'class' => 'btn btn-success showModalButton', 
				'title' => 'Add City',
				'value' => Url::to(['city/create', 'modal' => 1])
			]) . ' ' . 
			Html::button('Add Building', [
				'class' => 'btn btn-success showModalButton', 
				'title' => 'Add Building',
				'value' => Url::to(['building/create', 'modal' => 1])
			]);
			
			?>
		</div>
		</div>
		
		<div class="box-body">
		<?php 
		$buildingDesc = empty($model->bldg_code) ? '' : BuildingMaster::findOne($model->bldg_code)->name;
		$cityDesc = empty($model->city_code) ? '' : CityMaster::findOne($model->city_code)->name;
		
		echo $form->field($model, 'name');
		echo $form->field($model, 'bldg_code')->widget(Select2::className(), [
			'initValueText' => $buildingDesc, // set the initial display text
			'options' => ['placeholder' => 'Search for a building ...'],
			'pluginOptions' => [
				'allowClear' => true,
				'minimumInputLength' => 3,
				'language' => [
					'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
				],
				'ajax' => [
					'url' => Url::to(['building/get-buildings']),
					'dataType' => 'json',
					'data' => new JsExpression('function(params) { return {q:params.term}; }')
				],
				'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
				'templateResult' => new JsExpression('function(city) { return city.text; }'),
				'templateSelection' => new JsExpression('function (city) { return city.text; }'),
			],
		]);
		echo $form->field($model, 'city_code')->widget(Select2::className(), [
			'initValueText' => $cityDesc, // set the initial display text
			'options' => ['placeholder' => 'Search for a city ...'],
			'pluginOptions' => [
				'allowClear' => true,
				'minimumInputLength' => 3,
				'language' => [
					'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
				],
				'ajax' => [
					'url' => Url::to(['city/get-cities']),
					'dataType' => 'json',
					'data' => new JsExpression('function(params) { return {q:params.term}; }')
				],
				'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
				'templateResult' => new JsExpression('function(city) { return city.text; }'),
				'templateSelection' => new JsExpression('function (city) { return city.text; }'),
			],
		]);
		echo $form->field($model, 'noslots');
		
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
$this->registerJsFile(Yii::$app->homeUrl . 'js/ajax-modal-popup.js', ['depends' => 'yii\web\jQueryAsset']);

?>