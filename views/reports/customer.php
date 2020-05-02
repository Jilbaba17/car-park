<?php
/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
$this->title = 'Customer Report';
?>
<?= \nullref\datatable\DataTable::widget([
    'data' => $dataProvider->getModels(),
    'dom' => 'Bfrtip',
    'buttons' => [
        'excel',
        'pdf'
    ],
    'tableOptions' => [
        'class' => 'table table-striped table-bordered',
    ],
    'paging' => false,
    'columns' => [
        'customer_id',
        'customer_contact',
        [
            'data' => 'customer_regularornew',
            'filter' => \app\models\Customer::CUSTOMER_TYPE
        ],
        'customer_registrationdate'
    ],
]) ?>