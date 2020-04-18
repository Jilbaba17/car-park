<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
	<div class="col-md-12">
		<div class="box box-success">
			
			<div class="box-body">
			<?= \nullref\datatable\DataTable::widget([
				'ajax' => Url::to(['index', 'ajax' => true]),
			    'columns' => [
			    	['data' => 'names', 'title' => 'Names', 'defaultContent' => '(Not set)'],
			    	['data' => 'profile.department', 'title' => 'Department', 'defaultContent' => '(Not Assigned)'],
			    	[
			    			'data' => 'company.name', 
			    			'title' => 'Company Name', 
			    			'defaultContent' => '(Not Assigned)', 
			    			'visible' => Yii::$app->user->can('SUPER_ADMIN') ? true : false
			    			
			    	],
			    	['data' => 'phone_number', 'title' => 'Phone Number', 'defaultContent' => '(Not Assigned)'],
			    	
			    	[
			    			'data' => 'profile.gender', 
			    			'title' => 'Gender', 
			    			
			    	],
			    	
			    	//['data' => 'doissue', 'title' => 'Issued On', 'defaultContent' => '(Not Issued)'],
			    	
// 		    		[
// 		    				'class' => 'nullref\datatable\LinkColumn',
// 		    				'url' => \yii\helpers\Url::to(['tags/assign']),
// 		    				'options' => [
// 		    						'class' => 'bEdit btn btn-info btn-xs text-center',
// 		    				],
// 		    				'queryParams' => ['tagid'],
// 		    				'label' => \kartik\icons\Icon::show('link') .  '</i>Assign',
// 		    				//"targets" => count($columnsArray) ++
// 		    		],
			    	[
			    		'class' => 'nullref\datatable\LinkColumn',
			    		'url' => \yii\helpers\Url::to(['users/update']),
			    		'options' => [
			    			'class' => 'bEdit btn btn-success btn-xs text-center',
			    		],
			    		'queryParams' => ['id'],
			    		'label' => \kartik\icons\Icon::show('pencil') .  '</i>Edit',
			    		//"targets" => count($columnsArray) ++
			    	],
			    	[
			    		'class' => 'nullref\datatable\LinkColumn',
			    		'url' => \yii\helpers\Url::to(['users/delete']),
			    		'options' => [
			    			'class' => 'bDelete btn btn-danger btn-xs text-center',
			    			'data-confirm' => 'Are you sure you want to delete this user?',
			    			'data-method' => 'post'
			    		],
			    		'queryParams' => ['id'],
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