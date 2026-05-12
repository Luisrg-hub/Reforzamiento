<?php

namespace backend\controllers;

use common\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new \common\models\User();
        $perfil = new \common\models\PerfilAdmin();

        if ($this->request->isPost) {
            // Cargamos los datos de ambos modelos desde el formulario
            if ($model->load($this->request->post()) && $perfil->load($this->request->post())) {
                
                // 1. Configuramos datos básicos de seguridad de Yii2 para el usuario
                $model->setPassword($model->password); // Suponiendo que agregaste un campo 'password' virtual
                $model->generateAuthKey();
                $model->status = \common\models\User::STATUS_ACTIVE;

                // 2. Iniciamos una Transacción (si uno falla, el otro no se guarda)
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($model->save()) {
                        // 3. Vinculamos el perfil con el ID del usuario recién creado
                        $perfil->id_usuario = $model->id;
                        if ($perfil->save()) {
                            $transaction->commit(); // ¡Todo bien! Guardamos en la BD
                            return $this->redirect(['view', 'id' => $model->id]);
                        }
                    }
                    $transaction->rollBack(); // Si algo falló en el perfil, deshacemos el usuario
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'perfil' => $perfil, // Pasamos la variable del perfil a la vista
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
    
    // Buscamos el perfil que le pertenece a este usuario
    $perfil = \common\models\PerfilAdmin::findOne(['id_usuario' => $id]);
    
    // Si por alguna razón el usuario no tiene perfil, creamos uno nuevo vacío
    if (!$perfil) {
        $perfil = new \common\models\PerfilAdmin();
    }

    if ($this->request->isPost && $model->load($this->request->post()) && $perfil->load($this->request->post())) {
        
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            if ($model->save() && $perfil->save()) {
                $transaction->commit();
                return $this->redirect(['view', 'id' => $model->id]);
            }
            $transaction->rollBack();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    return $this->render('update', [
        'model' => $model,
        'perfil' => $perfil, // <--- Aquí es donde se la pasamos a la vista
    ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
