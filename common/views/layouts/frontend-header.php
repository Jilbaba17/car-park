<?php
use \yii\helpers\Html;
use yii\widgets\Menu;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use rmrevin\yii\ionicon\Ion;
use kartik\icons\Icon;
use kartik\alert\Alert;

Icon::map($this);
/* @var $this \yii\web\View */
?>
<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
   <!--  <a href="<?php // Yii::$app->homeUrl ?>" class="logo"> -->
        <!-- mini logo for sidebar mini 50x50 pixels -->
<!--         <span class="logo-mini"><i class="fa fa-home"></i></span> -->
        <!-- logo for regular state and mobile devices -->
       <!--  <span class="logo-lg"><?php // Html::encode(Yii::$app->name) ?></span>-->
<!--     </a> -->

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
    <div class="container">
    	<div class="navbar-header">
    		<a href="<?= Yii::$app->homeUrl ?>" class="navbar-brand"><?= Yii::$app->name ?></a>
<!--           <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse"> -->
<!--             <i class="fa fa-bars"></i> -->
<!--           </button> -->
    	</div>
    
        <!-- Sidebar toggle button-->
<!--         <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> -->
<!--             <span class="sr-only">Toggle navigation</span> -->
<!--         </a> -->

<!--        <div class="collapse navbar-collapse pull-left" id="navbar-collapse"> -->
<!--           <ul class="nav navbar-nav"> -->
<!--           	<li><a href="#">Home</a></li> -->
<!--             <li class="active"><a href="#">Treatment <span class="sr-only">(current)</span></a></li> -->
            
<!--           </ul> -->
          
<!--        </div> -->
    <?php
//     NavBar::begin([
        
//         'options' => [
//             'class' => 'navbar navbar-static-top',
//         ],
//     	'renderInnerContainer' => false,
//     	'containerOptions' => [
//     		'class' => 'navbar-custom-menu'
//     ]
    	
//     ]);
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
    			'items' => [
//     				'<span class="t-up"></span>',
    				['label' => Icon::show('user', [], Icon::BSG) . '<span>My Profile</span>',
    					'url' => ['//user/1']],
    					//                    ['label' => Icon::show('star', [], Icon::BSG) . 'Activity Log', 'url' => '#'],
    				['label' => Icon::show('cog', [], Icon::BSG) . '<span>Account Settings</span>', 
    				'url' => ['//user/settings/account']],
    				//                    ['label' => Icon::show('question-sign', [], Icon::BSG) . 'Help', 'url' => '#'],
    				//'<li class="divider"></li>',
    				[
    					'label'       => Icon::show('log-out', [], Icon::BSG) . '<span>Sign Out</span>',
    					'url'         => ['//user/logout'],
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
   <div class="navbar-custom-menu">
    
    <?php 
    echo Nav::widget([
    	'encodeLabels' => false,
        'options' => ['class' => 'nav navbar-nav'],
        'items' => $userMenuItems,
    	'dropDownCaret' => '',
    ]);
//     NavBar::end();
    ?>
    </div>
      
      </div>
    </nav>
</header>
