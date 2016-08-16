<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name' => 'Retain',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'auth' => [
            'class' => 'auth\Module',
            'layout' => '/main', // Layout when not logged in yet
            'layoutLogged' => '/main', // Layout for logged in users
            'attemptsBeforeCaptcha' => 9999, // Optional
            'supportEmail' => 'admin@pdf2html.demo.relevant.software', // Email for notifications
            'passwordResetTokenExpire' => 7200, // Seconds for token expiration
            'signupWithEmailOnly' => false, // false = signup with username + email, true = only email signup
            'tableMap' => [ // Optional, but if defined, all must be declared
                'User' => 'user',
                'UserStatus' => 'user_status',
                'ProfileFieldValue' => 'profile_field_value',
                'ProfileField' => 'profile_field',
                'ProfileFieldType' => 'profile_field_type',
            ],
        ],
        'v1' => [
            'class' => 'app\modules\api\v1\Module',
        ],

    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'XX4Q3FdDVM5PcPIpMIKSI-dsonRZIAeZ',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'ruleTable' => 'AuthRule', // Optional
            'itemTable' => 'AuthItem',  // Optional
            'itemChildTable' => 'AuthItemChild',  // Optional
            'assignmentTable' => 'AuthAssignment',  // Optional
        ],
        'user' => [
            'class' => 'auth\components\User',
            'identityClass' => 'auth\models\User',
            'enableAutoLogin' => true,
        ],
        'sphinx' => [
            'class' => 'yii\sphinx\Connection',
            'dsn' => 'mysql:host=localhost;dbname=pdftohtml',
            'username' => 'pdf2html',
            'password' => 'retainpdftohtml'
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/mailer',
            'htmlLayout' => false,
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => '127.0.0.1',
//                'username' => '',
//                'password' => '',
                'port' => '25',
//                'encryption' => 'tls',
            ],
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
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,

            'rules' => [

                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => [
                        'v1/project',
                        'v1/document',
                        'v1/tags',
                        'v1/note',
                    ],
                    'pluralize' => false,
                ],

//              'POST, OPTIONS v1/project' => 'v1/project',

                '' => 'projects/index',
                '<controller>/<action>' => '<controller>/<action>',
                '<controller>/<action>/<id:\d+>' => '<controller>/<action>',

            ],
        ],

        'response' => [
            'class' => 'yii\web\Response',
//            'format' => \yii\web\Response::FORMAT_JSON,
            'on beforeSend' => function ($event) {
                $response = $event->sender;

                if ( $response->format == 'json' && $response->data !== null) {
                    $response->data = [
                        'success' => $response->isSuccessful,
                        'data' => $response->data,
                    ];
                }
            },
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
