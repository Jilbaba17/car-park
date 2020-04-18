<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use common\assets\AppAsset;
use kartik\icons\Icon;
use common\assets\AdminLteAsset;
$appAssetBundle = AppAsset::register($this);
AdminLteAsset::register($this);
Icon::map($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= $appAssetBundle->baseUrl ?>/favicon.ico?v=2" type="image/x-icon" />
    
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) . ' - ' . Yii::$app->name ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition login-page">
<?php $this->beginBody() ?>
<?php 
if(Yii::$app->session->hasFlash('success') || Yii::$app->session->hasFlash('danger') || 
		Yii::$app->session->hasFlash('warning') || Yii::$app->session->hasFlash('info')) {
	foreach (Yii::$app->session->getAllFlashes() as $type => $message):; ?>
            <?php
            //print_r(Yii::$app->session->getAllFlashes());
            echo \kartik\widgets\Growl::widget([
                'type' => $type,
                'title' => $type,
                'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
                'body' => $message,
                'showSeparator' => true,
                'delay' => 1, //This delay is how long before the message shows
                'pluginOptions' => [
                    'delay' => 3000, ///This delay is how long the message shows for
                    'placement' => [
                        'from' => 'top',
                        'align' => 'right',
                    ]
                ]
            ]);
            ?>
        <?php endforeach; 
		}
        ?>
<div class="login-box">
  <div class="login-logo">
    <a href="<?= Yii::$app->homeUrl ?>"><img src="<?= $appAssetBundle->baseUrl ?>/images/logo_risksur.png" /></a>
  </div>
  <!-- /.login-logo -->
  <?= $content ?>
</div>
<!-- /.login-box -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
