<?php
use yii\helpers\Html;
use common\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

    Wkii\AdminLTE\Asset\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title><?= Yii::$app->name ?> | <?= Html::encode($this->title) ?></title>
        <?= Html::csrfMetaTags() ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?php $this->head() ?>
    </head>
    <body class="hold-transition <?= $this->assetBundles['Wkii\AdminLTE\Asset\AdminLteAsset']->skin; ?> layout-top-nav">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'frontend-header.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <?php /* = $this->render(
            'main-sidebar.php',
            ['directoryAsset' => $directoryAsset]
        )
        */ ?>

        <?= $this->render(
            'main-content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        )
        ?>

        <?= $this->render('main-content-footer.php')?>

        <?= $this->render(
            'main-control-sidebar.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
