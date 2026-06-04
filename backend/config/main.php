<?php

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
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
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
        'as access' => [
            'class' => 'yii\filters\AccessControl',
            'except' => ['site/login', 'site/error'], // Rutas públicas permitidas
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'], // Exigir que esté logueado
                    'matchCallback' => function ($rule, $action) {
                        // Verificación en tiempo real si el usuario actual es administrador
                        return (new \yii\db\Query())
                            ->from('perfil_admin')
                            ->where(['id_usuario' => Yii::$app->user->id])
                            ->exists();
                    },
                ],
            ],
            'denyCallback' => function ($rule, $action) {
                // Si un intruso intenta forzar la URL, lo deslogueamos y lo mandamos al login
                Yii::$app->user->logout();
                return Yii::$app->response->redirect(['site/login']);
            },
        ],
        'params' => $params,
    ];