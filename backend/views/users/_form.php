<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;
use kartik\widgets\Select2;
use common\models\Block;
use common\models\CityMaster;
use yii\web\JsExpression;
use common\models\Customer;
use dektrium\rbac\models\AuthItem;

/**
 * @var $model common\models\Customer
 * @var $this yii\web\View
 */
$this->params['breadcrumbs'][] = $this->title;
$form = ActiveForm::begin([
    'id' => 'user-form',
    'enableClientValidation' => true
]);
?>

<div class="row">

    <div class="box box-primary">

        <div class="box-body">
            <?php
            $buildingDesc = empty($model->company_id) ? '' : Customer::findOne($model->company_id)->name;
            // 		$cityDesc = empty($model->city_code) ? '' : CityMaster::findOne($model->city_code)->name;

            echo $form->field($model, 'user_firstName');
            echo $form->field($model, 'user_lastName');
            echo $form->field($model, 'user_username');
            echo $form->field($model, 'user_email');

            echo $form->field($model, 'user_phone_number');
            if (Yii::$app->user->identity->user_role == 'SUPER_ADMIN') {
                echo $form->field($model, 'user_customer_id')->dropDownList(Customer::getCustomers());
            } else {
                echo $form->field($model, 'user_customer_id')->hiddenInput(['value' => Yii::$app->user->identity->company_id])->label(false);
            }

            if (Yii::$app->user->can('SUPER_ADMIN')) {
                $items = [
                    'SUPER_ADMIN' => 'SUPER ADMIN',
                    'GUARD' => 'GUARD',
                    'USER' => 'USER'
                ];
                echo $form->field($model, 'user_role')->dropDownList(array_reverse($items, true));
            }


            ?>
        </div>

        <div class="box-footer">
            <?=
            Html::button('Save', [
                'class' => 'btn btn-success',
                'type' => 'submit'
            ]);

            ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
