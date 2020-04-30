<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Customer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'customer_id',
            'customer_contact',
            [
                'label' => 'Custormer Type',
                'value' => function ($model) {
                    return \app\models\Customer::CUSTOMER_TYPE[$model->customer_regularornew];

                }

            ],
            'customer_registrationdate',
            'customer_loginid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
