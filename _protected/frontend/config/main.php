<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        // here you can set theme used for your frontend application 
        // - template comes with: 'default', 'slate', 'spacelab' and 'cerulean'
        'view' => [
            'theme' => [
                'pathMap' => ['@app/views' => '@webroot/themes/beta/views'],
                'baseUrl' => '@web/themes/beta',
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\UserIdentity',
            'enableAutoLogin' => false,
       ],			
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
			'rules' => array(

				'/' => 'site/landing',
				'/registration' => 'site/signup',
				'/contact-us.html' => 'site/contact',
				'/men' => 'men/index',
				'/women/product/<id:.*?>' => 'women/product',
				'/men/product/<id:.*?>' => 'men/product',
				'/account' => 'account/index',


				'/<slug:.*?>.html'=>'/site/page',
			),   
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
