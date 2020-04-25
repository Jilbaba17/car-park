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
			    	[
			    			'data' => 'company.name', 
			    			'title' => 'Company Name', 
			    			'defaultContent' => '(Not Assigned)', 
			    			'visible' => Yii::$app->user->identity->user_role == 'SUPER_ADMIN'
			    			
			    	],
			    	['data' => 'user_phone_number', 'title' => 'Phone Number', 'defaultContent' => '(Not Assigned)'],
			    	

			    	[
			    		'class' => 'nullref\datatable\LinkColumn',
			    		'url' => \yii\helpers\Url::to(['users/update']),
			    		'options' => [
			    			'class' => 'bEdit btn btn-success btn-xs text-center',
			    		],
			    		'queryParams' => ['id'],
			    		'label' => \kartik\icons\Icon::show('edit') .  '</i>Edit',
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