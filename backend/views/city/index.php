<?php

use yii\helpers\Url;
use yii\bootstrap\Html;
use kartik\icons\Icon;
use nullref\datatable\LinkColumn;
/* @var $this yii\web\View */
$this->title = 'Cities';

$this->params['breadcrumbs'][] = $this->title;
/* @var $this yii\web\View */

?>
<div class="row">
	<div class="col-md-12">
		<div class="box box-success">
		<div class="box-header">
			<div class="pull-right"><?= Html::button(Icon::show('info-circle') . "CSV Upload?", [
					'class' => 'showModalButton btn btn-success',
					'value' => Url::to(['city/csv-info']),
					'title' => 'City CSV upload',
					//'data-modal-size' => 'modal-sm'
					
			]) ?></div></div>
			<div class="box-body">
			<?= \nullref\datatable\DataTable::widget([
				'ajax' => Url::to(['index', 'ajax' => true]),
			    'columns' => [
			    	['data' => 'name', 'width' => "70%", "title" => "Name"],
			    	
			    	[
			    		'class' => 'nullref\datatable\LinkColumn',
			    		'url' => \yii\helpers\Url::to(['city/update']),
			    		'options' => [
			    			'class' => 'bEdit btn btn-success btn-xs text-center',
			    			"width" => "10%"
			    				
			    		],
			    		'queryParams' => ['id'],
			    		'label' => \kartik\icons\Icon::show('pencil') .  '</i>Edit',
			    			
			    		//"targets" => count($columnsArray) ++
			    	],
			    	[
			    		'class' => 'nullref\datatable\LinkColumn',
			    		'url' => \yii\helpers\Url::to(['city/delete']),
			    		'options' => [
			    			'class' => 'bDelete btn btn-danger btn-xs text-center',
			    			'data-confirm' => 'Are you sure you want to delete this city?', 
			    			'data-method' => 'post',
			    			"width" => "10%",
			    				
			    		],
			    			
			    		'queryParams' => ['id'],
			    		'label' => \kartik\icons\Icon::show('trash') .  '</i>Delete',
			    	]
			        //'noslots'
			    ],
// 				'responsive' => true,
				'tableOptions'=>[
					'class'=>'table table-striped table-bordered',
				],
			]); 
// 			LinkColumn::class
			?>
			</div>
			

		</div>
	</div>
</div>
<?php
$this->registerJsFile(Yii::$app->homeUrl . 'js/ajax-modal-popup.js', ['depends' => 'yii\web\jQueryAsset']);

?>
