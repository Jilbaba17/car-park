<?php

use yii\helpers\Url;
use yii\bootstrap\Html;
use kartik\icons\Icon;

/* @var $this yii\web\View */
$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">

			<div class="box-body">
			<?= \nullref\datatable\DataTable::widget([
				'ajax' => Url::to(['index', 'ajax' => true]),
                'dom' => 'Bfrtip',
                'buttons' => [
                    'excel',
                    'pdf'
                ],
			    'columns' => [
			        'customer_name',
			    	['data' => 'block.Block_name', 'title' => 'Block Name'],
			    	['data' => 'block.Block_address', 'title' => 'Block Address'],
			        'customer_noslots',
			    	[
			    		'class' => 'nullref\datatable\LinkColumn',
			    		'url' => \yii\helpers\Url::to(['company/update']),
			    		'options' => [
			    			'class' => 'btn btn-success btn-xs text-center',
			    		],
			    		'queryParams' => ['customer_id'],
			    		'label' => \kartik\icons\Icon::show('edit') .  '</i>Edit',
			    		//"targets" => count($columnsArray) ++
			    	],
			    	[
			    		'class' => 'nullref\datatable\LinkColumn',
			    		'url' => \yii\helpers\Url::to(['company/delete']),
			    		'options' => [
			    			'class' => 'btn btn-danger btn-xs text-center',
			    			'data-confirm' => 'Are you sure you want to delete this company?',
			    			'data-method' => 'post'
			    		],
			    		'queryParams' => ['customer_id'],
			    		'label' => \kartik\icons\Icon::show('trash') .  '</i>Delete',
			    		//"targets" => count($columnsArray) ++
			    	]
			        //'customer_noslots'
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
