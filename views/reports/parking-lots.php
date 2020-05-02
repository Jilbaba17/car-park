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
        'park_id',
        'park_code',
        ['data' => 'block.block_code', 'title' => 'Block code'],
        [
            'data' => 'park_valetparking',
            'filter' => \app\models\ParkingLot::VALET_PARKING
        ],
        'park_slotnumberfrom',
        'park_slotnumberto',

    ],
]) ?>