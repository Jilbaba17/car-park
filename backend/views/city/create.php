<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CityMaster */

$this->title = 'Add City';
$this->params['breadcrumbs'][] = ['label' => 'City', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-master-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
