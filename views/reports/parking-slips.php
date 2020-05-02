<?php
/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
$this->title = 'Parking lots Report';
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
        'parking_slip_id',
        'parking_slip_customerid',
        'parking_slip_carplatenumber',
        'parking_slip_carcolor',
        'parkingSlipPark.park_code',
        'parking_slip_slotnumber',
        'parking_slip_date',
        'parking_slip_dateto',
        'parking_slip_datefrom',

    ],
]) ?>