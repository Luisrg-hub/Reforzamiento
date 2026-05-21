<?php

namespace backend\controllers;

use yii;
use common\models\PerfilAlumno;
use backend\models\PerfilAlumnoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;
use Exception;
/**
 * PerfilAlumnoController implements the CRUD actions for PerfilAlumno model.
 */
class PerfilAlumnoController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all PerfilAlumno models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PerfilAlumnoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PerfilAlumno model.
     * @param int $id_usuario Id Usuario
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_usuario)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_usuario),
        ]);
    }

    /**
     * Creates a new PerfilAlumno model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new PerfilAlumno();
        $modelUser = new User();

        // Si se envió el formulario con datos para AMBOS modelos
        if ($model->load(Yii::$app->request->post()) && $modelUser->load(Yii::$app->request->post())) {
            
            // Configuraciones de seguridad para el usuario de Yii2
            $modelUser->generateAuthKey();
            $modelUser->setPassword($modelUser->password); // Encripta la contraseña tecleada
            $modelUser->status = 10; // 10 = Usuario Activo

            // Iniciamos una transacción (Todo o nada)
            $transaction = Yii::$app->db->beginTransaction();
            try {
                // 1. Guardamos primero al Usuario
                if ($modelUser->save()) {
                    // 2. Le asignamos el ID del usuario recién creado al Perfil del Alumno
                    $model->id_usuario = $modelUser->id; // Ajusta 'user_id' si tu campo se llama distinto
                    
                    // 3. Guardamos el perfil
                    if ($model->save()) {
                        $transaction->commit(); // Si ambos se guardan, confirmamos la transacción
                        return $this->redirect(['view', 'id_usuario' => $model->id_usuario]);
                    }
                }
                // Si algo falla, deshacemos todo
                $transaction->rollBack();
            } catch (Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelUser' => $modelUser, // Pasamos el modelo User a la vista
        ]);
    }

    /**
     * Updates an existing PerfilAlumno model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_usuario Id Usuario
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_usuario)
    {
        // Esto ya lo tienes (Busca el perfil del alumno)
        $model = $this->findModel($id_usuario);

        // Buscamos la cuenta de usuario vinculada en la base de datos
        // Usamos la ruta completa del modelo User de la plantilla advanced
        $modelUser = \common\models\User::findOne($id_usuario); 

        // el if hace que cargue y guarde ambos formularios
        if ($this->request->isPost) {
            $perfilCargado = $model->load($this->request->post());
            $usuarioCargado = $modelUser->load($this->request->post());
            
            // Si ambos recibieron datos y ambos se guardan sin errores en la BD...
            if ($perfilCargado && $usuarioCargado) {
                if ($model->save() && $modelUser->save()) {
                    return $this->redirect(['view', 'id_usuario' => $model->id_usuario]);
                }
            }
        }

        // Esto ahora sí funcionará porque $modelUser ya existe y tiene datos
        return $this->render('update', [
            'model' => $model,
            'modelUser' => $modelUser,
        ]);
    }

    /**
     * Deletes an existing PerfilAlumno model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_usuario Id Usuario
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_usuario)
    {
        $this->findModel($id_usuario)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PerfilAlumno model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_usuario Id Usuario
     * @return PerfilAlumno the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_usuario)
    {
        if (($model = PerfilAlumno::findOne(['id_usuario' => $id_usuario])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
