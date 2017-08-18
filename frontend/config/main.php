<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'homeUrl'             => '/',
    'id'                  => 'app-frontend',
    'name'                => 'Jenadin',
    'basePath'            => dirname(__DIR__),
    'bootstrap'           => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules'             => [
        'page'    => [
            'class' => 'frontend\modules\page\Module',
        ],
        'website' => [
            'class' => 'frontend\modules\website\Module',
        ],
    ],
    'components'          => [
        'user'         => [
            'identityClass'   => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'cache'        => [
            'class' => 'yii\caching\FileCache',
        ],
//        'log'          => [
//            'traceLevel' => YII_DEBUG ? 3 : 0,
//            'targets'    => [
//                [
//                    'class'  => 'yii\log\FileTarget',
//                    'levels' => ['error', 'warning'],
//                ],
//            ],
//        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'request'      => [
            'baseUrl' => '',
            'class'   => 'common\components\LangRequest',
        ],
        'i18n'         => [
            'class'        => \common\components\I18N::className(),
            'translations' => [
                'yii' => [
                    'class' => \yii\i18n\DbMessageSource::className()
                ]
            ],
        ],
        'urlManager'   => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => [
                [
                    'pattern' => 'sitemap.xml',
                    'route'   => 'website/default/generate-sitemap',
                ],
                [
                    'pattern' => '/website/<action>',
                    'route'   => '/website/<action>'
                ],
                [
                    'pattern' => '/website/<action>',
                    'route'   => '/website/<action>'
                ],
                [
                    'pattern' => '/basket/<action>',
                    'route'   => 'shop/basket/<action>'
                ],
                '/<url:[a-zA-Z0-9-]+>' => 'page/default/show',
            ]
        ],
        'view'         => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@frontend/web/themes/virtue4d'
                ],
            ],
        ],
        'basket'       => [
            'class'        => 'frontend\\components\\BasketComponent',
            'userClass'    => 'common\\models\\User',
            'productClass' => 'backend\\models\\Product',
        ],
        'assetManager' => [
            'linkAssets' => true,
        ],
    ],
    'params'              => $params,
    'defaultRoute'        => 'page/default/show',
];
