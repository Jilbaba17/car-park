<?php

use yii\helpers\Url;
use kartik\icons\Icon;
use yii\bootstrap\Html;

/* @var $this yii\web\View */
$this->title = 'Blocks';

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
                        'Block_name',
//			    	'city.name',
                        'Block_address',
                        'Block_tot_slots',

                        [
                            'class' => 'nullref\datatable\LinkColumn',
                            'url' => \yii\helpers\Url::to(['building/update']),
                            'options' => [
                                'class' => 'btn btn-success btn-xs text-center',
                            ],
                            'queryParams' => ['id'],
                            'label' => \kartik\icons\Icon::show('edit') . '</i>Edit',

                            //"targets" => count($columnsArray) ++
                        ],
                        [
                            'class' => 'nullref\datatable\LinkColumn',
                            'url' => \yii\helpers\Url::to(['building/delete']),
                            'options' => [
                                'class' => 'btn btn-danger btn-xs text-center',
                                'data-confirm' => 'Are you sure you want to delete this city?',
                                'data-method' => 'post',
                                "width" => "5%"

                            ],
                            'queryParams' => ['id'],
                            'label' => \kartik\icons\Icon::show('trash') . '</i>Delete',
                        ]
                        //'noslots'
                    ],
                    'responsive' => true,
                    'tableOptions' => [
                        'class' => 'table table-striped table-bordered responsive',
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
