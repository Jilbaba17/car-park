<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            //'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                'file' => [
                    //'class' => 'yii\log\FileTarget',
                    //'levels' => ['error', 'warning'],
                    'logFile' => '@runtime/logs/parking-backend.log'
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    	'mailer' => [
    		'class' => 'yii\swiftmailer\Mailer',
    		'viewPath' => '@common/mail',
    		// send all mails to a file by default. You have to set
    		// 'useFileTransport' to false and configure a transport
    		// for the mailer to send real emails.
    		'useFileTransport' => false,
    		'transport' => $params['mail']
    	],
    	
    
    ],
    'params' => $params,
];
