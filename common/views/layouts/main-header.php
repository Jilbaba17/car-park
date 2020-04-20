<?php
use \yii\helpers\Html;
use kartik\icons\Icon;
use yii\bootstrap\Nav;

/* @var $this \yii\web\View */
?>
<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="<?= Yii::$app->homeUrl ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><i class="fa fa-car"></i></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><?= Html::encode(Yii::$app->name) ?></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
      <?php
    //if (!Yii::$app->user->isGuest) {
    	
    	$userMenuItems = [
    		
    		[
    			'label' => Icon::show('user', [], Icon::BSG) . '<span class="hidden-xs">' .
    			Yii::$app->user->identity->firstName . ' ' . Yii::$app->user->identity->lastName . '</span>',
    			'linkOptions' => [
    				'class' => "dropdown-toggle",
    				'title' => "My Profile"
    			],
    			'options' => [
    				'class' => 'dropdown'
    			],
    			'dropdownOptions' => [
	    			'class' => 'menu'
	    		],
    			'items'       => [
//     				'<span class="t-up"></span>',
//     				['label' => Icon::show('user', [], Icon::BSG) . '<span>My Profile</span>',
//     					'url' => ['//user/1']],
    					//                    ['label' => Icon::show('star', [], Icon::BSG) . 'Activity Log', 'url' => '#'],
//     				['label' => Icon::show('cog', [], Icon::BSG) . '<span>Account Settings</span>', 
//     				'url' => ['//user/settings/account']],
    				//                    ['label' => Icon::show('question-sign', [], Icon::BSG) . 'Help', 'url' => '#'],
    				//'<li class="divider"></li>',
    				[
    					'label'       => Icon::show('log-out', [], Icon::BSG) . '<span>Sign Out</span>',
    					'url'         => ['site/logout'],
    					'linkOptions' => ['data-method' => 'post'],
//     					'options' => [
// 	    					'class' => 'footer'
// 	            		]
    				],
    				
    			]
    		],

    	];
   // }
    ?>
    
    <?php 
    echo Nav::widget([
    	'encodeLabels' => false,
        'options' => ['class' => 'nav navbar-nav'],
        'items' => $userMenuItems,
    	'dropDownCaret' => '',
    ]);
    //NavBar::end();
    ?>

                <!-- Control Sidebar Toggle Button -->
<!--                 <li> -->
<!--                     <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> -->
<!--                 </li> -->
        </div>
    </nav>
</header>
