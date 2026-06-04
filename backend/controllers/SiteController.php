<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
        return $this->goHome();
    }

    $model = new \common\models\LoginForm(); // Usa el formulario común
    
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
        
        // --- NUEVO FILTRO DE SEGURIDAD ---
        // Verificamos si el usuario que se acaba de loguear existe en la tabla perfil_admin
        $isAdmin = (new \yii\db\Query())
            ->from('perfil_admin')
            ->where(['id_usuario' => Yii::$app->user->id])
            ->exists();

        if (!$isAdmin) {
            // Si no es administrador, lo deslogueamos inmediatamente
            Yii::$app->user->logout();
            // Le pintamos el error en la pantalla de login
            $model->addError('password', 'Acceso denegado. Esta cuenta no tiene privilegios de administrador.');
            
            return $this->render('login', [
                'model' => $model,
            ]);
        }
        // ---------------------------------

        return $this->goBack();
    }

    $model->password = '';

    return $this->render('login', [
        'model' => $model,
    ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
