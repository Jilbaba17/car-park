<?php



/* @var $this yii\web\View */
/* @var $model common\models\CityMaster */

$this->title = 'Update Tag: ' . $model->tagid;
$this->params['breadcrumbs'][] = ['label' => 'Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tagid, 'url' => ['index']];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tag-master-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
