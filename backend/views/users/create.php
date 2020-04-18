<?php

/* @var $this yii\web\View */
/* @var $model common\models\CityMaster */

$this->title = 'Add User';
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <?= $this->render('_form', [
        'model' => $model,
    	'profile' => $profile
    ]) ?>

</div>
