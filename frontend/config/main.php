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
    'name'                => 'Help Micro',
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
        'shop'    => [
            'class' => 'frontend\modules\shop\Module',
        ],
        'api'     => [
            'class' => 'frontend\modules\api\Module',
        ]
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
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
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
                [
                    'pattern' => '/search',
                    'route'   => 'shop/categories/search'
                ],
                [
                    'pattern' => 'sitemap.xml',
                    'route'   => 'website/default/generate-sitemap',
                ],
                [
                    'pattern' => '/product/action/<action>',
                    'route'   => 'shop/products/<action>',
                ],
                [
                    'pattern'      => '/product-category/<alias:[a-zA-Z0-9-\/]+>',
                    'route'        => 'shop/categories/view',
                    'encodeParams' => false,
                ],
                [
                    'pattern' => '/product/<alias:[a-zA-Z0-9-]+>',
                    'route'   => 'shop/products/view',
                ],
                [
                    'class'         => 'yii\rest\UrlRule',
                    'controller'    => ['api/customer'],
                    'tokens'        => [
                        '{id}'     => '<id:\\w+>',
                        '{email}'  => '<email>',
                        '{serial}' => '<serial>',
                        '{dic}'    => '<dic>'
                    ],
                    'extraPatterns' => [
                        'POST get-record' => 'get-record'
                    ]
                ],
                [
                    'class'         => 'yii\rest\UrlRule',
                    'controller'    => ['api/novelty'],
                    'tokens'        => [
                        '{id}'        => '<id:\\w+>',
                        '{noveltyID}' => '<noveltyID>'
                    ],
                    'extraPatterns' => [
                        'GET get-novelties'                => 'get-novelties',
                        'GET get-unread-count/{noveltyID}' => 'get-unread-count'
                    ]
                ],
                '/<url:[a-zA-Z0-9-]+>' => 'page/default/show',
            ]
        ],
        'view'         => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@frontend/web/themes/helpMicro'
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
