<?php

use common\models\User;

?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <section class="sidebar">

        <?= Wkii\AdminLTE\Widgets\Menu::widget([
            'items' => [
                ['label' => 'NAVIGATION', 'options' => ['class' => 'header']],
            		
            		['label' => 'Check In / Check out', 'url' => false, 'icon' => 'fa-car', 'pjax'=>true,
            				'visible' => in_array(Yii::$app->user->identity->user_role, User::CHECKIN_ROLES),
            				'items' => [
            						[
            								'label' => 'Check In',
            								'url' => ['/site/index', 'operation' => 'checkIn'],
            								'icon' => 'fa-sign-in',
            						],
            						[
            								'label' => 'Check out',
            								'url' => ['/site/index', 'operation' => 'checkOut'],
            								'icon' => 'fa-sign-out',
            						],
            				],
            		],

            	['label' => 'Cities', 'url' => false, 'icon' => 'fa-globe', 'pjax'=>true, 
            			'visible' => false, //Yii::$app->user->identity->role == 'SUPER_ADMIN',
            		'items' => [
	            		[
	            			'label' => 'View Cities',
	            			'url' => ['/city/index'],
	            			'icon' => 'fa-link',
	            		],
            			[
            				'label' => 'Add City',
            				'url' => ['/city/create'],
            				'icon' => 'fa-link',
            			],
            		],
            	],
            	['label' => 'Blocks', 'url' => false, 'icon' => 'fa-building', 'pjax'=>true,
                    'visible' => Yii::$app->user->identity->user_role == 'SUPER_ADMIN',
            		'items' => [
            			[
            				'label' => 'View Blocks',
            				'url' => ['/building/index'],
            				'icon' => 'fa-link',
            			],
            			[
            				'label' => 'Add Block',
            				'url' => ['/building/create'],
            				'icon' => 'fa-link',
            			],
            		],
            	],
            	['label' => 'Customers', 'url' => false, 'icon' => 'fa-user-tie', 'pjax'=>true,
                    'visible' => Yii::$app->user->identity->user_role == 'SUPER_ADMIN',
            		'items' => [
            			[
            				'label' => 'View Customers',
            				'url' => ['/company/index'],
            				'icon' => 'fa-link',
            			],
            			[
            				'label' => 'Add Customer',
            				'url' => ['/company/create'],
            				'icon' => 'fa-link',
            			],
            		],
            	],
            	['label' => 'Parking Slots', 'url' => false, 'icon' => 'fa-car', 'pjax'=>true,
                    'visible' => Yii::$app->user->identity->user_role == 'SUPER_ADMIN',
            		'items' => [
            			[
            				'label' => 'View Slots',
            				'url' => ['/tags/index'],
            				'icon' => 'fa-link',
            			],
            			[
            				'label' => 'Add Slot',
            				'url' => ['/tags/create'],
            				'icon' => 'fa-link',
            			],
//             			[
//             				'label' => 'Assign Tag',
//             				'url' => ['/tags/assign'],
//             				'icon' => 'fa-link',
//             			],
            		],
            	],
            		['label' => 'Messaging', 'url' => false, 'icon' => 'fa-envelope', 'pjax'=>true,
            				'visible' => Yii::$app->user->can('GUARD'),
            				'items' => [
            						[
            								'label' => 'Send Message',
            								'url' => ['/message/index'],
            								'icon' => 'fa-link',
            						],
            						
            				],
            		],
                ['label' => 'Manage Users', 'url' => false, 'icon' =>'fa-users', 'pjax'=>true,
            			'visible' => Yii::$app->user->identity->user_role == 'SUPER_ADMIN',
                		['label' => 'View Users', 'url' => ['/users/index'], 'icon' => 'fa-link'],
                		['label' => 'Add users', 'url' => ['/users/create'], 'icon' => 'fa-link'],
                ]

//                 [
//                     'label' => 'Level One',
//                     'url' => 'javascript:;',
//                     'icon' => 'fa-folder',
//                     'items' => [
//                         [
//                             'label' => 'Level Two',
//                             'url' => '#',
//                             'icon' => 'fa-link',
//                         ],
//                         [
//                             'label' => 'Level Two',
//                             'url' => '#',
//                             'icon' => 'fa-link',
//                         ],
//                         [
//                             'label' => 'Level Two',
//                             'url' => '#',
//                             'icon' => 'fa-share',
//                             'items' => [
//                                 [
//                                     'label' => 'Level Three',
//                                     'url' => '#',
//                                     'icon' => 'fa-link'
//                                 ],
//                                 [
//                                     'label' => 'Level Three',
//                                     'url' => '#',
//                                     'icon' => 'fa-folder',
//                                     'items' => [
//                                         [
//                                             'label' => 'Level Four',
//                                             'url' => '#',
//                                         ],
//                                         [
//                                             'label' => 'Level Four',
//                                             'url' => '#',
//                                         ],
//                                     ],
//                                 ],
//                             ],
//                         ],
//                     ],
//                 ],
            ],
        ]) ?>

    </section>
    <!-- /.sidebar -->
</aside>
