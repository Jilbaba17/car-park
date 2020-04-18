<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CityMaster */

$this->title = 'Add Tag';
$this->params['breadcrumbs'][] = ['label' => 'Tag', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-master-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
