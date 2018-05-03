<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','oauth2'],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'admins' => ['mosvits'],
            'mailer' => [
                'sender'                => ['prakt@ros.kpi.ua'=> 'Мосійчук В.С.'], // or ['no-reply@myhost.com' => 'Sender name']
                'welcomeSubject'        => 'Welcome subject - Привітання',
                'confirmationSubject'   => 'Confirmation subject - Підтведження emeil',
                'reconfirmationSubject' => 'Email change subject - Повторне підтведження emeil',
                'recoverySubject'       => 'Recovery subject - Відновлення паролю',
            ],
            'modelMap' => [
                'RegistrationForm' => 'app\models\RegistrationForm',
                'User' => 'app\models\User',
                //'Profile' => 'app\models\Profile',
            ],

        ],
        'v1' => [
            'basePath' => '@app/modules/v1',
            'class' => 'app\modules\v1\Api'
        ],
        'oauth2' => [
            'class' => 'filsh\yii2\oauth2server\Module',
            'tokenParamName' => 'accessToken',
            'tokenAccessLifetime' => 3600,
            'storageMap' => [
                'user_credentials' => 'app\models\User',
            ],
            'grantTypes' => [
                'user_credentials' => [
                    'class' => 'OAuth2\GrantType\UserCredentials',
                ],
                'refresh_token' => [
                    'class' => 'OAuth2\GrantType\RefreshToken',
                    'always_issue_new_refresh_token' => true
                ]
            ]
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
        ],
        'room' => [
            'class' => 'app\modules\room\Module',
        ],
//        'gridview' =>  [
//            'class' => 'kartik\grid\Module',
//        ],
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'v1/default/*',
            'v1/*',
            'admin/*', // add or remove allowed actions to this list
            'dht/*',
            'user/*',
            'room/*',
            'swagger/*',
            'api/*',
            'location/*',
            'receipt/*',
            'charging/*',
            'ventmode/*',
            'heatmode/*',
            'setup/*',
            'param/*',
            'settings/*',
            'venting/*',
            'heating/*',
            'site/*',
            'smoke/*',
            'debug/*',
            'gii/*',
            'film/*',
            'films/*',
            'oauth2/*'
//            'versioning/*',

            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@app/views/user'
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
        ],
        'authClientCollection' => [
            'class' => yii\authclient\Collection::className(),
            'clients' => [
                'facebook' => [
                    'class'        => 'dektrium\user\clients\Facebook',
                    'clientId'     => 'CLIENT_ID',
                    'clientSecret' => 'CLIENT_SECRET',
                ],
                'twitter' => [
                    'class'          => 'dektrium\user\clients\Twitter',
                    'consumerKey'    => 'CONSUMER_KEY',
                    'consumerSecret' => 'CONSUMER_SECRET',
                ],
                'google' => [
                    'class'        => 'dektrium\user\clients\Google',
                    'clientId'     => 'CLIENT_ID',
                    'clientSecret' => 'CLIENT_SECRET',
                ],
                'github' => [
                    'class'        => 'dektrium\user\clients\GitHub',
                    'clientId'     => '4892090',
                    'clientSecret' => 'B9U0wFqCjW4xXxTB8QQQ',
                ],
                'linkedin' => [
                    'class'        => 'dektrium\user\clients\LinkedIn',
                    'clientId'     => '4892090',
                    'clientSecret' => 'B9U0wFqCjW4xXxTB8QQQ',
                ],
            ],
        ],
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'gyTIjTve4nBiBg2hiMVi_mPNSVNFS0E2',
//            'baseUrl'=> '',
//            'enableCsrfValidation' => false,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
//        'user' => [
//            'identityClass' => 'app\models\User',
//            'enableAutoLogin' => true,
//        ],
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'POST oauth2/<action:\w+>' => 'oauth2/rest/<action>',
                ['class' => 'yii\rest\UrlRule', 'prefix' => '/api','controller' => 'v1/dht',
                    'extraPatterns' => [
                        'GET test' => 'test',
                        'POST add' => 'add',
                        'PUT update/<id:\d+>' => 'update',
                        'DELETE delete/<id:\d+>' => 'delete',
                        'POST,GET last' => 'last',
                        'POST get/<id:\d+>' => 'get',
                        'POST search' => 'search',
                        'POST datecount' => 'datecount',
                        'POST first' => 'first',
                        'POST sendevent' => 'sendevent',
                        'POST firstlastdates' => 'firstlastdates',
                        'GET index' => 'index'
                    ]],
                ['class' => 'yii\rest\UrlRule', 'prefix' => '/api', 'controller' => 'v1/bmp',
                    'extraPatterns' => [
                        'GET test' => 'test',
                        'POST add' => 'add',
                        'PUT update/<id:\d+>' => 'update',
                        'DELETE delete/<id:\d+>' => 'delete',
                        'POST last' => 'last',
                        'POST get/<id:\d+>' => 'get',
                        'POST search' => 'search',
                        'POST datecount' => 'datecount',
                        'POST first' => 'first',
                        'POST sendevent' => 'sendevent',
                        'POST firstlastdates' => 'firstlastdates',
                        'GET index' => 'index'
                    ]],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/default', 'extraPatterns' => [

                ]],
//                    'api/<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                'petrowski/swagger' => 'v1/default/docs',
//                '<controller>/<action>' => '<controller>/<action>'
            ],
        ],
        /**/
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
