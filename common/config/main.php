<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'layoutPath' => '@common/views/layouts',
    'name' => 'CAR PARK SYSTEM',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                'file' => [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@frontend/views/site/user' => '@common/views/user',
                    //'@dektrium/user/views/registration' => '@common/views/registration'

                ],
            ],
        ],
        'assetManager' => [
            'linkAssets' => true,
            'bundles' => [
//
                'Wkii\AdminLTE\Asset\AdminLteAsset' => [
                    'skin' => 'skin-blue',
                ],
                'Wkii\AdminLTE\Asset\FontAwesomeAsset' => [
                    'css' => [
                        'css/all.min.css',
                    ],
                    'publishOptions' => [
                        'beforeCopy' => function ($from, $to) {
                            return preg_match('%(/|\\\\)(webfonts|css)%', $from);
                        },
                        'only' => [
                            'webfonts/*',
                            'css/*',
                        ]
                    ]

                ],
                'nullref\datatable\DataTableAsset' => [
                    'styling' => false,
                    'js' => [
                        'datatables/media/js/jquery.dataTables.min.js',
                        'datatables/media/js/dataTables.bootstrap.min.js',
                        'datatables-plugins/sorting/natural.js',
                        'datatables-responsive/js/dataTables.responsive.js',
                        'datatables.net-buttons/js/dataTables.buttons.min.js',
                        'datatables.net-buttons-bs/js/buttons.bootstrap.min.js',
                        'jszip/dist/jszip.min.js',
                        'pdfmake/build/pdfmake.min.js',
                        'pdfmake/build/vfs_fonts.js',
                        'datatables.net-buttons/js/buttons.html5.min.js',

                    ],
                    'css' => [
                        'datatables/media/css/dataTables.bootstrap.min.css',
                        'datatables.net-bs/css/dataTables.bootstrap.css',
                        'datatables.net-buttons-bs/css/buttons.bootstrap.min.css',

                    ],
                    'depends' => [
                        'yii\web\JqueryAsset',
                        'yii\bootstrap\BootstrapAsset',
                    ],
                ],
            ],
        ],

    ],
    'modules' => [
//		'rbac' => 'dektrium\rbac\RbacWebModule',
        'gridview' => [
            'class' => '\kartik\grid\Module',
        ],
//		'user' => [
//			'class' => 'dektrium\user\Module',
//			'enableUnconfirmedLogin' => true,
//			'enableRegistration' => false,
//			'enableConfirmation' => false,
//			'enableFlashMessages' => false,
//			'enablePasswordRecovery' => false,
//			'confirmWithin' => 21600,
//			'cost' => 12,
//			'admins' => ['admin'],
//			'adminPermission' => 'ADMIN',
//			'modelMap' => [
//				'LoginForm' => 'common\models\LoginForm',
//				'User' => 'common\models\User',
//				'RegistrationForm' => 'common\models\RegistrationForm',
//			],
//			'controllerMap' => [
//				'admin' => [
//					'class' => '\dektrium\user\controllers\AdminController',
//				],
//				'recovery' => [
//					'class' => '\common\controllers\RecoveryController',
//					'layout' => '/login',
//				],
//				'security' => [
//					'class' => '\common\controllers\SecurityController',
//					'layout' => '/single',
//				],
//				'registration' => [
//					'class' => '\common\controllers\RegistrationController',
//					'layout' => '//login',
//				],
//			],
//		],
    ],
];
