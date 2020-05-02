<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Payments', 'url' => ['/payments/create'], 'visible' => Yii::$app->user->identity->login_rank == 'ADMIN'],
            ['label' => 'Operations', 'url' => '#', 'visible' => Yii::$app->user->identity->login_rank == 'ADMIN', 'items' => [
                ['label' => 'Manage Floors', 'url' => ['/floor/index']],
                ['label' => 'Manage Blocks', 'url' => ['/block/index']],
                ['label' => 'Manage Parking Lots', 'url' => ['/parking-lot/index']],
                ['label' => 'Manage Parking Slips', 'url' => ['/parking-slip/index']],
                ['label' => 'Manage Customers', 'url' => ['/customer/index']],
                ['label' => 'Manage Administrators', 'url' => ['/administrator/index']],
                ['label' => 'Manage Users', 'url' => ['/login/index']],
                ['label' => 'Manage Payments', 'url' => ['/payments/index']],
            ]
            ],
            ['label' => 'Reports', 'url' => ['#'], 'visible' => Yii::$app->user->identity->login_rank == 'ADMIN', 'items' =>[
                ['label' => 'Floors', 'url' => ['/reports/floors']],
                ['label' => 'Blocks', 'url' => ['/reports/blocks']],
                ['label' => 'Parking Lots', 'url' => ['/reports/parking-lots']],
                ['label' => 'Parking Slips', 'url' => ['/reports/parking-slips']],
                ['label' => 'Customers', 'url' => ['/reports/customer']],
                ['label' => 'Administrators', 'url' => ['/reports/administrator']],
                ['label' => 'Payments', 'url' => ['/reports/payments']],
            ]],
            Yii::$app->user->isGuest ? (
            ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->name . ' ' . date('Y') ?></p>

        <p class="pull-right"><? // Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
