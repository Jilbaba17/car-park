<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'CAR PARK SYSTEM',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'timeZone' => 'Africa/Nairobi',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'dfkhds90fr439757y932q4y432yrne39hr90fojnwe9rh329ffs',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Login',
            'enableAutoLogin' => true,
        ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'assetManager' => [
          'linkAssets' => true,
          'bundles' => [
              'nullref\datatable\assets\DataTableBaseAsset' => [
                  'sourcePath' => '@bower',
                  'styling' => \nullref\datatable\assets\DataTableAsset::STYLING_BOOTSTRAP,
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
                      'datatables.net-buttons-bs/css/buttons.bootstrap.min.css',

                  ],
                  'depends' => [
                      'yii\web\JqueryAsset',
                      'yii\bootstrap\BootstrapAsset',
                  ],
              ],
          ]
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
