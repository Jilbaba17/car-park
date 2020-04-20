<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;
use kartik\widgets\Select2;
use common\models\Block;
use common\models\CityMaster;
use yii\web\JsExpression;

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
		
		
		echo $form->field($model, 'tagid');
		
		
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

?>