<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Block */

$this->title = 'Add Block';
$this->params['breadcrumbs'][] = ['label' => 'Building', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="building-master-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
