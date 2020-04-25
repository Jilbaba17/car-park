<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\icons\Icon;

/* @var $this yii\web\View */
$this->title = 'Parking Slots';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
	<div class="col-md-12">
		<div class="box box-success">
			
			<div class="box-body">
			<?= \nullref\datatable\DataTable::widget([
				'ajax' => Url::to(['index', 'ajax' => true]),
			    'columns' => [
			        'park_tagid',
			    	['data' => 'user.names', 'title' => 'Assigned To', 'defaultContent' => '(Not Assigned)'],
			    	['data' => 'customer.customer_name', 'title' => 'Customer', 'defaultContent' => '(Not Assigned)'],
			    	['data' => 'park_car_model', 'title' => 'Car Model', 'defaultContent' => '(Not Assigned)'],
			    	['data' => 'park_car_regno', 'title' => 'Car Reg No', 'defaultContent' => '(Not Assigned)'],
			    		
			    	
			    	['data' => 'park_doissue', 'title' => 'Issued On', 'defaultContent' => '(Not Issued)'],
			    	
			    		[
			    				'data' => 'park_tagstatus',
			    				'title' => 'Status',
			    				'defaultContent' => Icon::show('link') .  Html::a('Assign', Url::to(['tags/assign']), ['class' => 'btn btn-info']),
			    				"createdCell" => new \yii\web\JsExpression("function (td, cellData, rowData, row, col) {
								console.log(cellData);
								link = '/tags/assign?park_tagid=' + rowData.park_tagid;
								$(td).html('" .  Html::a(Icon::show('link') . 'Assign', Url::to(['tags/assign']), ['class' => 'btn btn-xs btn-info']) . "')
								$(td).children('a').attr('href', link);
				    			if ( cellData == 1 ) {
									link = '/tags/assign?park_tagid=' + rowData.park_tagid + '&unassign=1';
				    				$(td).html('" . Html::a(Icon::show('link') . 'Un-assign', '#', ['class' => 'btn btn-xs btn-warning']) . "');
									$(td).children('a').attr('href', link);
				    			}
			    			}")
			    		],
			    	[
			    		'class' => 'nullref\datatable\LinkColumn',
			    		'url' => \yii\helpers\Url::to(['tags/update']),
			    		'options' => [
			    			'class' => 'bEdit btn btn-success btn-xs text-center',
			    		],
			    		'queryParams' => ['park_tagid'],
			    		'label' => \kartik\icons\Icon::show('edit') .  '</i>Edit',
			    		//"targets" => count($columnsArray) ++
			    	],
			    	[
			    		'class' => 'nullref\datatable\LinkColumn',
			    		'url' => \yii\helpers\Url::to(['tags/delete']),
			    		'options' => [
			    			'class' => 'bDelete btn btn-danger btn-xs text-center',
			    			'data-confirm' => 'Are you sure you want to delete this tag?',
			    			'data-method' => 'post'
			    		],
			    		'queryParams' => ['park_tagid'],
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