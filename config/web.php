<?php

use \yii\web\Request;

$params = require(__DIR__ . '/params.php');

$baseUrl = str_replace('/web', '', (new Request)->getBaseUrl());

$config = [
    'id' => 'basic',
    'name' => 'Kirchland',
    'language' => 'uk-UA',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','assetsAutoCompress'],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
    ],
    'controllerMap' => [
        'file-manager-elfinder' => [
            'class' => 'mihaildev\elfinder\Controller',
            'access' => ['@'],
            'disabledCommands' => ['netmount'],
            'roots' => [
                [
                    'baseUrl' => '@app/web',
                    'basePath' => '@app/web',
                    'path' => '/',
                    'name' => 'Корень'
                ]
            ]
        ]
    ],
    'aliases' => [
        '@adminModuleViews' => '@app/modules/admin/views'
    ],
    'components' => [
        'assetsAutoCompress' => [
            'class' => '\skeeks\yii2\assetsAuto\AssetsAutoCompressComponent',
            'enabled' => (YII_ENV_DEV) ? false : true,

            'readFileTimeout' => 1,           //Time in seconds for reading each asset file

            'jsCompress' => true,        //Enable minification js in html code
            'jsCompressFlaggedComments' => true,        //Cut comments during processing js

            'cssCompress' => true,        //Enable minification css in html code

            'cssFileCompile' => true,        //Turning association css files
            'cssFileRemouteCompile' => false,       //Trying to get css files to which the specified path as the remote file, skchat him to her.
            'cssFileCompress' => true,        //Enable compression and processing before being stored in the css file
            'cssFileBottom' => false,       //Moving down the page css files
            'cssFileBottomLoadOnJs' => false,       //Transfer css file down the page and uploading them using js

            'jsFileCompile' => true,        //Turning association js files
            'jsFileRemouteCompile' => true,       //Trying to get a js files to which the specified path as the remote file, skchat him to her.
            'jsFileCompress' => false,        //Enable compression and processing js before saving a file
            'jsFileCompressFlaggedComments' => true,        //Cut comments during processing js

            'noIncludeJsFilesOnPjax' => true,        //Do not connect the js files when all pjax requests

            'htmlFormatter' => [
                //Enable compression html
                'class' => 'skeeks\yii2\assetsAuto\formatters\html\TylerHtmlCompressor',
                'extra' => true,       //use more compact algorithm
                'noComments' => true,        //cut all the html comments
                'maxNumberRows' => 50000,       //The maximum number of rows that the formatter runs on


            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'qDvXyhBcJ1DjdfXIP6uLAwz4zbCXLfR2',
            'baseUrl' => $baseUrl,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'session' => [
            'name' => '_SessionId',
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
        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'baseUrl' => $baseUrl,
            'rules' => [
                '/' => 'site/index',
                '<module:[\wd-]+>/<controller:[\wd-]+>/<action:[\wd-]+>/<id:\d+>' => '<module>/<controller>/<action>',
                '<module:[\wd-]+>/<controller:[\wd-]+>/<action:[\wd-]+>' => '<module>/<controller>/<action>'
            ],
            'languages' => [
                'ua' => 'uk-UA',
                'ru' => 'ru-RU',
//                'en' => 'en-US'
            ],
            'enableDefaultLanguageUrlCode' => false,
            'enableLanguagePersistence' => false,
            'enableLanguageDetection' => false
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => [
                        YII_ENV_DEV
                            ? 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.js'
                            : 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js'
                    ]
                ],
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-yellow-light',
                ],
            ]
        ],
        'i18n' => [
            'translations' => [
                'local' => [
                    'class' => 'yii\i18n\PhpMessageSource'
                ],
                '*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'forceTranslation' => true,
                    'messageTable' => 'source_message_translation'
                ],
//                'app*' => [
//                    'class' => 'yii\i18n\PhpMessageSource',
//                    'basePath' => '@app/messages',
//                    'forceTranslation' => true,
//                    'fileMap' => [
//                        'app' => 'local.php',
//                    ],
//                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
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
