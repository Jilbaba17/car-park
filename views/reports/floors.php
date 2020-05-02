<?php
/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
$this->title = 'Floors Report';
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
        'floor_id',
        'floor_number',
        'floor_maxheight',
        'floor_numberofblocks'
    ],
]) ?>