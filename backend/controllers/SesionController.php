<?php

namespace backend\controllers;
use yii;
use common\models\PerfilAlumno;
use common\models\Sesion;
use backend\models\SesionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SesionController implements the CRUD actions for Sesion model.
 */
class SesionController extends Controller
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
     * Lists all Sesion models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SesionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sesion model.
     * @param int $id ID
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
     * Creates a new Sesion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {

    // Redirigimos al inicio porque el Admin no debe crear sesiones
    return $this->redirect(['index']);

    }

    /**
     * Updates an existing Sesion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Sesion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sesion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Sesion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sesion::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionListaInscritos($id)
    {
        $sesion = $this->findModel($id);
        
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => \common\models\PerfilAlumno::find()
                ->innerJoin('alumno_sesion', 'alumno_sesion.id_alumno = perfil_alumno.id_usuario')
                ->where(['alumno_sesion.id_sesion' => $id]),
        ]);

        return $this->render('lista-inscritos', [
            'sesion' => $sesion,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Inscribe a un alumno (Vista Admin)
     */
    public function actionInscribirAlumno($id)
    {
        $sesion = $this->findModel($id);
        
        if (Yii::$app->request->isPost) {
            $id_alumno = Yii::$app->request->post('id_alumno');
            try {
                Yii::$app->db->createCommand()->insert('alumno_sesion', [
                    'id_sesion' => $id,
                    'id_alumno' => $id_alumno,
                ])->execute();
                
                Yii::$app->session->setFlash('success', 'Alumno inscrito correctamente.');
                return $this->redirect(['lista-inscritos', 'id' => $id]);
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('error', 'El alumno ya está inscrito o hubo un error.');
            }
        }

        $alumnos = \common\models\PerfilAlumno::find()->all();

        return $this->render('inscribir-alumno', [
            'sesion' => $sesion,
            'alumnos' => $alumnos,
        ]);
    }

    /**
     * Quita a un alumno (Vista Admin)
     */
    public function actionQuitarAlumno($id_sesion, $id_alumno)
    {
        Yii::$app->db->createCommand()
            ->delete('alumno_sesion', ['id_sesion' => $id_sesion, 'id_alumno' => $id_alumno])
            ->execute();

        Yii::$app->session->setFlash('success', 'Alumno desvinculado de la sesión.');
        return $this->redirect(['lista-inscritos', 'id' => $id_sesion]);
    }
}
