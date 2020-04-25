<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;
use kartik\widgets\Select2;
use common\models\Block;
use yii\web\JsExpression;

/**
 * @var $model common\models\Customer
 * @var $this yii\web\View 
 */
$this->params['breadcrumbs'][] = $this->title;
$form = ActiveForm::begin([
	'id' => 'company-form'
]);
?>

<div class="col-md-12">

	<div class="box box-primary">
		
		<div class="box-header with-border">
			<h3 class="box-title invisible"> Add Customer</h3>
			<div class="box-tools pull-right">
		
			<?=
//			Html::button('Add City', [
//				'class' => 'btn btn-success showModalButton',
//				'title' => 'Add City',
//				'value' => Url::to(['city/create', 'modal' => 1])
//			]) . ' ' .
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
		$buildingDesc = empty($model->customer_bldg_code) ? '' : Block::findOne($model->customer_bldg_code)->Block_name;

		echo $form->field($model, 'customer_name');
		echo $form->field($model, 'customer_bldg_code')->dropDownList(Block::getBlocks());
//		
		echo $form->field($model, 'customer_noslots');
		
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
