<?php
/* @var $this yii\web\View */
/* @var $model common\models\CityMaster */

$this->title = 'Assign Tag';
$this->params['breadcrumbs'][] = ['label' => 'Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tagid, 'url' => ['index']];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tag-master-assign">


    <?= $this->render('_assign', [
        'model' => $model,
    ]) ?>

</div>
