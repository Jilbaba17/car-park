<?php
/* @var $this yii\web\View */
/* @var $model common\models\CityMaster */

$this->title = 'Update User';
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['index']];
?>
<div class="user-update">

    <?= $this->render('_form', [
        'model' => $model,
    	'profile' => $profile,
    ]) ?>

</div>