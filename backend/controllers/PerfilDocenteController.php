<?php

namespace backend\controllers;

use common\models\PerfilDocente;
use backend\models\PerfilDocenteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PerfilDocenteController implements the CRUD actions for PerfilDocente model.
 */
class PerfilDocenteController extends Controller
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
     * Lists all PerfilDocente models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PerfilDocenteSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PerfilDocente model.
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
     * Creates a new PerfilDocente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    
    public function actionCreate()
    {
        $model = new \common\models\PerfilDocente();
        $user = new \common\models\User();
        if ($this->request->isPost) {
            
            // 1. Cargamos los datos del formulario
            if ($user->load($this->request->post()) && $model->load($this->request->post())) {
                
                // 2.  Validamos que las reglas se cumplan (que no haya campos vacíos)
                if ($user->validate() && $model->validate()) {
                    
                    // Como ya validamos, es seguro encriptar la contraseña porque sabemos que no está vacía
                    $user->setPassword($user->password);
                    $user->generateAuthKey();
                    $user->status = \common\models\User::STATUS_ACTIVE;

                    $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        // Ponemos save(false) porque la validación ya la hicimos arriba
                        if ($user->save(false)) { 
                            $model->id_usuario = $user->id;
                            if ($model->save(false)) {
                                $transaction->commit();
                                return $this->redirect(['view', 'id_usuario' => $model->id_usuario]);
                            }
                        }
                        $transaction->rollBack();
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                        throw $e;
                    }
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'user' => $user,
        ]);
    }
    

    /**
     * Updates an existing PerfilDocente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_usuario Id Usuario
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_usuario)
    {
        $model = $this->findModel($id_usuario);
    // Buscamos la cuenta de usuario asociada
    $user = \common\models\User::findOne($id_usuario);

    if ($this->request->isPost && $model->load($this->request->post()) && $user->load($this->request->post())) {
        
        // Opcional: Solo encriptar si el administrador escribió algo en el campo password
        if (!empty($user->password)) {
            $user->setPassword($user->password);
        }

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            if ($user->save() && $model->save()) {
                $transaction->commit();
                return $this->redirect(['view', 'id_usuario' => $model->id_usuario]);
            }
            $transaction->rollBack();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    return $this->render('update', [
        'model' => $model,
        'user' => $user, // Enviamos el usuario a la vista
    ]);
    }

    /**
     * Deletes an existing PerfilDocente model.
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
     * Finds the PerfilDocente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_usuario Id Usuario
     * @return PerfilDocente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_usuario)
    {
        if (($model = PerfilDocente::findOne(['id_usuario' => $id_usuario])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
