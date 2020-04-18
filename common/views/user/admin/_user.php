<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 11/8/16
 * Time: 2:35 PM
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

/**
 * @var yii\widgets\ActiveForm      $form
 * @var dektrium\user\models\User   $user
 */
?>

<?= $form->field($user, 'email')->textInput(['maxlength' => 255]) ?>
<?= $form->field($user, 'firstName')->textInput(['maxlength' => 50]) ?>
<?= $form->field($user, 'lastName')->textInput(['maxlength' => 50]) ?>
<?= $form->field($user, 'password')->passwordInput() ?>
