<?php

use yii\helpers\Url;
use yii\bootstrap\Html;
use kartik\icons\Icon;

/* @var $this yii\web\View */
$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
	<div class="col-md-12">
		<div class="box box-success">
			<div class="box-header">
			<div class="pull-right"><?= Html::button(Icon::show('info-circle') . "CSV Upload?", [
					'class' => 'showModalButton btn btn-success',
					'value' => Url::to(['company/csv-info']),
					'title' => 'Company CSV upload',
					//'data-modal-size' => 'modal-sm'
					
			]) ?></div></div>
			<div class="box-body">
			<?= \nullref\datatable\DataTable::widget([
				'ajax' => Url::to(['index', 'ajax' => true]),
			    'columns' => [
			        'name',
			    	['data' => 'building.name', 'title' => 'Building Name'],
			    	['data' => 'building.address', 'title' => 'Building Address'],
			    	['data' => 'building.city.name', 'title' => 'City'],
			        'noslots',
			    	[
			    		'class' => 'nullref\datatable\LinkColumn',
			    		'url' => \yii\helpers\Url::to(['company/update']),
			    		'options' => [
			    			'class' => 'bEdit btn btn-success btn-xs text-center',
			    		],
			    		'queryParams' => ['cid'],
			    		'label' => \kartik\icons\Icon::show('pencil') .  '</i>Edit',
			    		//"targets" => count($columnsArray) ++
			    	],
			    	[
			    		'class' => 'nullref\datatable\LinkColumn',
			    		'url' => \yii\helpers\Url::to(['company/delete']),
			    		'options' => [
			    			'class' => 'bDelete btn btn-danger btn-xs text-center',
			    			'data-confirm' => 'Are you sure you want to delete this company?',
			    			'data-method' => 'post'
			    		],
			    		'queryParams' => ['cid'],
			    		'label' => \kartik\icons\Icon::show('trash') .  '</i>Delete',
			    		//"targets" => count($columnsArray) ++
			    	]
			        //'noslots'
			    ],
				'responsive' => true,
				'tableOptions'=>[
					'class'=>'table table-striped table-bordered responsive',
				],
			]); 
			?>
			</div>
			

		</div>
	</div>
</div>

<?php
$this->registerJsFile(Yii::$app->homeUrl . 'js/ajax-modal-popup.js', ['depends' => 'yii\web\jQueryAsset']);

?>