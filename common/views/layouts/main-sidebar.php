<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <section class="sidebar">

        <?= Wkii\AdminLTE\Widgets\Menu::widget([
            'items' => [
                ['label' => 'NAVIGATION', 'options' => ['class' => 'header']],
            		
            		['label' => 'Check In / Check out', 'url' => false, 'icon' => 'fa-car', 'pjax'=>true,
            				'visible' => Yii::$app->user->can('GUARD'),
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
            			'visible' => Yii::$app->user->can('SUPER_ADMIN'),
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
            	['label' => 'Buildings', 'url' => false, 'icon' => 'fa-building', 'pjax'=>true,
            			'visible' => Yii::$app->user->can('SUPER_ADMIN'),
            		'items' => [
            			[
            				'label' => 'View Buildings',
            				'url' => ['/building/index'],
            				'icon' => 'fa-link',
            			],
            			[
            				'label' => 'Add Building',
            				'url' => ['/building/create'],
            				'icon' => 'fa-link',
            			],
            		],
            	],
            	['label' => 'Companies', 'url' => false, 'icon' => 'fa-briefcase', 'pjax'=>true,
            			'visible' => Yii::$app->user->can('SUPER_ADMIN'),
            		'items' => [
            			[
            				'label' => 'View Companies',
            				'url' => ['/company/index'],
            				'icon' => 'fa-link',
            			],
            			[
            				'label' => 'Add Company',
            				'url' => ['/company/create'],
            				'icon' => 'fa-link',
            			],
            		],
            	],
            	['label' => 'Tags', 'url' => false, 'icon' => 'fa-tags', 'pjax'=>true,
            			'visible' => Yii::$app->user->can('GUARD'),
            		'items' => [
            			[
            				'label' => 'View Tags',
            				'url' => ['/tags/index'],
            				'icon' => 'fa-link',
            			],
            			[
            				'label' => 'Add Tag',
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
            		'visible' => Yii::$app->user->can('COMPANY_ADMIN'), 'items' => [
                		['label' => 'View Users', 'url' => ['/users/index'], 'icon' => 'fa-link'],
                		['label' => 'Add users', 'url' => ['/users/create'], 'icon' => 'fa-link'],
            		]
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