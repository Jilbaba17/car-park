<?php
/*
 * This file is part of the Dektrium project.
*
* (c) Dektrium project <http://github.com/dektrium>
*
* For the full copyright and license information, please view the LICENSE.md
* file that was distributed with this source code.
*/

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//use Yii;
use kartik\icons\Icon;
/**
 * @var yii\web\View              $this
 * @var app\models\RegistrationForm $model
 * @var dektrium\user\Module      $module
 */

$this->title = Yii::t('user', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;

Icon::map($this, Icon::BSG);
?>
<div class="register-box-body">
                <p class="login-box-msg"><?= Html::encode($this->title) ?></p>
                <?php $form = ActiveForm::begin([
                    'id'                     => 'registration-form',
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                	'fieldConfig' => [
							'template' => "{input}\n{hint}\n{error}\n",
                			'options' => ['class' => 'form-group has-feedback']
							//'wrapperOptions' => ['class' => 'input-group']
                	]
                ]); ?>

                <?= $form->field($model, 'email', ['inputTemplate' => '{input}' . Icon::show('envelope', ['class' => 'form-control-feedback'], null, false, 'span')])
                ->textInput(['placeholder' =>'Email']);
                ?>

                <?= $form->field($model, 'firstName', ['inputTemplate' => '{input}' . Icon::show('user', ['class' => 'form-control-feedback'], null, false, 'span')])
                ->textInput(['placeholder' =>'First Name']);
                ?>

                <?= $form->field($model, 'lastName', ['inputTemplate' => '{input}' . Icon::show('user', ['class' => 'form-control-feedback'], null, false, 'span')])
                ->textInput(['placeholder' =>'Last Name']);
                ?>

                <?php if ($module->enableGeneratingPassword == false): ?>
                    <?= $form->field($model, 'password', ['inputTemplate' => '{input}' . Icon::show('lock', ['class' => 'form-control-feedback'], null, false, 'span')])
                ->passwordInput(['placeholder' =>'Password']);
                    ?>
                <?= $form->field($model, 'passwordRepeat', ['inputTemplate' => '{input}' . Icon::show('thumbs-up', ['class' => 'form-control-feedback'], null, false, 'span')])
                ->passwordInput(['placeholder' =>'Confirm Passowrd']);
                ?>
                
                <?php endif ?>

                <?= Html::submitButton(Yii::t('user', 'Sign up'), ['class' => 'btn btn-primary btn-block']) ?>

                <?php ActiveForm::end(); ?>
        </div>
        <p class="text-center">
            <?= Html::a(Yii::t('user', 'Already registered? Sign in!'), ['/user/security/login']) ?>
        </p>
  
