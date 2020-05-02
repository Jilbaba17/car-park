<?php
/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
$this->title = 'Payments Report';
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
        'payment_id',
        [
                'data' => 'payment_mode',
                'filter' => \app\models\Payments::PAYMENT_MODES
        ],
        'payment_reference',
        'paymentParkingSlip.parking_slip_carplatenumber',
        'payment_amount',
        'paymentDate'

    ],
]) ?>