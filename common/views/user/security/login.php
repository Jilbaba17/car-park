<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 10/2/16
 * Time: 1:00 AM
 */

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use dektrium\user\widgets\Connect;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\icons\Icon;
/**
 * @var yii\web\View                   $this
 * @var dektrium\user\models\LoginForm $model
 * @var dektrium\user\Module           $module
 */
$this->title = \Yii::t('user', 'Sign in');
//$this->context->layout = '//login';
//$this->params['breadcrumbs'][] = $this->title;
Icon::map($this, Icon::FA);

?>
<!-- <form action="../../index2.html" method="post"> -->
<!--       <div class="form-group has-feedback"> -->
<!--         <input type="email" class="form-control" placeholder="Email"> -->
<!--         <span class="glyphicon glyphicon-envelope form-control-feedback"></span> -->
<!--       </div> -->
<!--       <div class="form-group has-feedback"> -->
<!--         <input type="password" class="form-control" placeholder="Password"> -->
<!--         <span class="glyphicon glyphicon-lock form-control-feedback"></span> -->
<!--       </div> -->
<!--       <div class="row"> -->
<!--         <div class="col-xs-8"> -->
<!--           <div class="checkbox icheck"> -->
<!--             <label> -->
<!--               <input type="checkbox"> Remember Me -->
<!--             </label> -->
<!--           </div> -->
<!--         </div> -->
        <!-- /.col -->
<!--         <div class="col-xs-4"> -->
<!--           <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button> -->
<!--         </div> -->
        <!-- /.col -->
<!--       </div> -->
<!--     </form> -->

<!--     <div class="social-auth-links text-center"> -->
<!--       <p>- OR -</p> -->
<!--       <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using -->
<!--         Facebook</a> -->
<!--       <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using -->
<!--         Google+</a> -->
<!--     </div> -->
    <!-- /.social-auth-links -->

<!--     <a href="#">I forgot my password</a><br> -->
<!--     <a href="register.html" class="text-center">Register a new membership</a> -->

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

  <!-- /.login-box-body -->
<!-- 	<div class="row"> -->
	
		<div class="login-box">
			<p class="login-box-msg">Welcome, please sign in</p>
		
			<div class="logo"><img src="<?= Yii::$app->homeUrl ?>images/parqur-logo.png" alt="LOGO GOES HERE" /></div>
			<div class="panel panel-body panel-login">
					<?php $form = ActiveForm::begin([
						'id'                     => 'login-form',
						'enableAjaxValidation'   => true,
						'enableClientValidation' => false,
						'validateOnBlur'         => false,
						'validateOnType'         => false,
						'validateOnChange'       => false,
						'fieldConfig' => [
							'template' => "{beginWrapper}\n{input}\n{hint}\n{endWrapper}\n{error}\n",
							'wrapperOptions' => ['class' => 'input-group']
//							'defaultCssClasses' => [
//								'label' => 'col-sm-4',
//								'offset' => 'col-sm-offset-4',
//								'wrapper' => 'col-sm-8',
//								'error' => '',
//								'hint' => '',
//							],
						],
					]) ?>

					<?= $form->field(
						$model,
						'phone_number',
						[
							'inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1'],
							'inputTemplate' => '<span class="input-group-addon">' . Icon::show('phone') . '</span>{input}'
						]
					)->input('phone', ['placeholder' => 'Enter your number']) ?>

					<?php 
					// $form
					// 	->field(
					// 		$model,
					// 		'password',
					// 		[
					// 			'inputOptions' => ['class' => 'form-control', 'tabindex' => '2'],
					// 			'inputTemplate' => '<span class="input-group-addon">' . Icon::show('lock fa-lg') . '</span>{input}',
					// 		]
					// 	)
					// 	->passwordInput()
					// 	->label(
					// 		Yii::t('user', 'Password')
					// 		.($module->enablePasswordRecovery ?
					// 			' (' . Html::a(
					// 				Yii::t('user', 'Forgot password?'),
					// 				['/user/recovery/request'],
					// 				['tabindex' => '5']
					// 			)
					// 			. ')' : '')
					// 	) 
						?>

					<?= $form->field($model, 'rememberMe')->checkbox(['tabindex' => '4']) ?>

					<?= Html::submitButton(
						Yii::t('user', 'Sign in'),
						['class' => 'btn btn-success btn-block', 'tabindex' => '3']
					) ?>

					<?php ActiveForm::end(); ?>
<!--				</div>-->
			</div>
			<p class="text-center">
					<?php // Html::a(Yii::t('user', 'Forgot password?'), ['/user/recovery/request']) ?>
				</p>
			<?php if ($module->enableConfirmation): ?>
				<p class="text-center">
					<?= Html::a(Yii::t('user', 'Didn\'t receive confirmation message?'), ['/user/registration/resend']) ?>
				</p>
			<?php endif ?>
			<?php if ($module->enableRegistration): ?>
				<p class="text-center">
					<?= Html::a(Yii::t('user', 'Don\'t have an account? Sign up!'), ['/user/registration/register']) ?>
				</p>
			<?php endif ?>
			<?= Connect::widget([
				'baseAuthUrl' => ['/user/security/auth'],
			]) ?>
		</div>
<!-- 	</div> -->

