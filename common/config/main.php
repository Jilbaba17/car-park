<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'layoutPath' => '@common/views/layouts',
	'name' => 'PARQ',
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
					'@dektrium/user/views' => '@common/views/user',
					//'@dektrium/user/views/registration' => '@common/views/registration'
					
				],
			],
		],
		'assetManager' => [
			'converter'=>[
				'class'=> 'nizsheanez\assetConverter\Converter',
				'force'=> true, // true : If you want convert your sass each time without time dependency
				'destinationDir' => 'css', //at which folder of @webroot put compiled files
				'parsers' => [
					'scss' => [ // file extension to parse
						'class' => 'nizsheanez\assetConverter\Scss',
						'output' => 'css', // parsed output file type
						'options' => [ // optional options
							'enableCompass' => true, // default is true
							'importPaths' => ['/sass','@bower/datatables-responsive/css/responsive.bootstrap.scss'], // import paths, you may use path alias here,
							// e.g., `['@path/to/dir', '@path/to/dir1', ...]`
							'lineComments' => true, // if true — compiler will place line numbers in your compiled output
							'outputStyle' => 'nested', // May be `compressed`, `crunched`, `expanded` or `nested`,
							// see more at http://sass-lang.com/documentation/file.SASS_REFERENCE.html#output_style
						],
					],
				]
			],
			'bundles' => [
				'Wkii\AdminLTE\Asset\AdminLteAsset' => [
					'skin' => 'skin-green',
				],
				'nullref\datatable\DataTableAsset' => [
					'styling' => false,
					'js' => [
						'datatables/media/js/jquery.dataTables.min.js',
						'datatables/media/js/dataTables.bootstrap.min.js',
						'datatables.net-plugins/sorting/natural.js',
						'datatables-responsive/js/dataTables.responsive.js'
						
					],
					'css' => [
						'datatables/media/css/dataTables.bootstrap.min.css',
						'datatables-responsive/css/responsive.dataTables.scss',
						
					],
					'depends' => [
						'yii\web\JqueryAsset',
						'yii\bootstrap\BootstrapAsset',
					]
				]
			],
		]
    
    ],
    'modules' => [
			'rbac' => 'dektrium\rbac\RbacWebModule',
			'gridview' =>  [
				'class' => '\kartik\grid\Module'
			],
			'user' => [
				'class' => 'dektrium\user\Module',
				'enableUnconfirmedLogin' => true,
				'enableRegistration' => false,
				'enableConfirmation' => false,
				'enableFlashMessages' => false,
				'enablePasswordRecovery' => false,
				'confirmWithin' => 21600,
				'cost' => 12,
				'admins' => ['admin'],
				'adminPermission' => 'ADMIN',
				'modelMap' => [
					'LoginForm' => 'common\models\LoginForm',
					'User' => 'common\models\User',
					'RegistrationForm' => 'common\models\RegistrationForm'
				],
				'controllerMap' => [
					'admin' => [
						'class'=>'\dektrium\user\controllers\AdminController',
					],
					'recovery' => [
						'class'=>'\common\controllers\RecoveryController',
						'layout' => '/login',
					],
					'security' => [
						'class'=>'\common\controllers\SecurityController',
						'layout' => '/single',
					],
					'registration' => [
						'class'=>'\common\controllers\RegistrationController',
						'layout' => '//login',
					]
				]
			],
		],
];
