<?php

namespace frontend\controllers;

use yii;
use common\models\PerfilAlumno;
use common\models\AlumnoSesion;
use common\models\Sesion;
use frontend\models\SesionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use kartik\mpdf\Pdf;

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
     * Muestra la lista de alumnos inscritos en una sesión específica.
     */
    public function actionListaInscritos($id)
        {
            // 1. Buscamos los datos de la sesión para mostrar el tema/fecha en el título
            $sesion = $this->findModel($id);
            
            // 2. Preparamos los datos de los alumnos inscritos consultando la tabla intermedia
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => \common\models\PerfilAlumno::find()
                    ->innerJoin('alumno_sesion', 'alumno_sesion.id_alumno = perfil_alumno.id_usuario')
                    ->where(['alumno_sesion.id_sesion' => $id]),
                'pagination' => [
                    'pageSize' => 20, // Cuántos alumnos mostrar por página
                ],
            ]);

            // 3. Enviamos todo a una nueva vista
            return $this->render('lista-inscritos', [
                'sesion' => $sesion,
                'dataProvider' => $dataProvider,
            ]);
        }
    /**
     * Creates a new Sesion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Sesion();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
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

    public function actionCatalogo()
    {
        // 1. Obtenemos el perfil del alumno actual
        $perfil = PerfilAlumno::findOne(['id_usuario' => Yii::$app->user->id]);

        if (!$perfil) {
            throw new \yii\web\NotFoundHttpException("No se encontró el perfil de alumno.");
        }

        // 2. Buscamos solo las sesiones Activas y que sean de la Carrera del alumno
        $query = Sesion::find()
            ->joinWith(['asignacion.asignatura']) // Traemos la materia para saber la carrera
            ->where(['asignatura.id_carrera' => $perfil->id_carrera])
            ->andWhere(['sesion.estado' => 1])
            ->orderBy('sesion.fecha ASC');

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('catalogo', [
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionInscribir($id_sesion)
    {
        $id_alumno = Yii::$app->user->id; // El id_usuario del alumno logueado

        // 1. Verificamos que no esté inscrito ya para evitar errores de duplicidad en la base de datos
        $existe = AlumnoSesion::findOne(['id_sesion' => $id_sesion, 'id_alumno' => $id_alumno]);

        if (!$existe) {
            $inscripcion = new AlumnoSesion();
            $inscripcion->id_sesion = $id_sesion;
            $inscripcion->id_alumno = $id_alumno;
            
            if ($inscripcion->save()) {
                Yii::$app->session->setFlash('success', '¡Te has inscrito a la sesión con éxito!');
            } else {
                Yii::$app->session->setFlash('error', 'Ocurrió un error al intentar inscribirte.');
            }
        } else {
            Yii::$app->session->setFlash('warning', 'Ya estás inscrito en esta asesoría.');
        }

        return $this->redirect(['catalogo']);
    }

        /**
     * Elimina a un alumno de una sesión manualmente (Solo Admin)
     */
    public function actionQuitarAlumno($id_sesion, $id_alumno)
    {

            // SEGURIDAD: Solo el admin puede ejecutar esto
        if (Yii::$app->user->identity->role !== 'admin') {
            throw new ForbiddenHttpException('No tienes permiso para realizar esta acción.');
        }
        // Ejecutamos el borrado en la tabla intermedia
        Yii::$app->db->createCommand()
            ->delete('alumno_sesion', ['id_sesion' => $id_sesion, 'id_alumno' => $id_alumno])
            ->execute();

        Yii::$app->session->setFlash('success', 'Alumno desvinculado de la sesión.');
        return $this->redirect(['lista-inscritos', 'id' => $id_sesion]);
    }

    /**
     * Permite al administrador inscribir a un alumno manualmente
     */
    public function actionInscribirAlumno($id)
    {
        $sesion = $this->findModel($id);
        
        // Si el formulario se envía...
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

        // Buscamos todos los alumnos para llenar un desplegable
        $alumnos = PerfilAlumno::find()->all();

        return $this->render('inscribir-alumno', [
            'sesion' => $sesion,
            'alumnos' => $alumnos,
        ]);
    }

    public function actionReportePdf($id)
    {
        // 1. Buscar la sesión con todas sus relaciones para optimizar la consulta
        $model = Sesion::find()
            ->where(['id' => $id])
            ->with(['asignacion.perfilDocente', 'asignacion.asignatura', 'alumnoSesiones.perfilAlumno'])
            ->one();

        if ($model === null) {
            throw new NotFoundHttpException('La sesión solicitada no existe.');
        }

        // 2. Renderizar una vista parcial de Yii de forma oculta (solo el HTML)
        $content = $this->renderPartial('_reporte_pdf', [
            'model' => $model,
        ]);

        // 3. Configurar el componente PDF de Kartik
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // Soporte para acentos y eñes
            'format' => Pdf::FORMAT_A4, // Tamaño del papel
            'orientation' => Pdf::ORIENT_PORTRAIT, // Orientación vertical
            'destination' => Pdf::DEST_BROWSER, // DEST_DOWNLOAD fuerza la descarga automática. Usa DEST_BROWSER si quieres que se abra primero en el navegador.
            'filename' => 'Reporte_Sesion_' . $model->id . '_' . date('Ymd-His') . '.pdf',
            'content' => $content,  
            'cssInline' => '
                body { font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; color: #333; }
                .header-table { width: 100%; border-bottom: 2px solid #2c3e50; padding-bottom: 10px; margin-bottom: 20px; }
                .title { font-size: 22px; color: #2c3e50; font-weight: bold; }
                .info-table { width: 100%; margin-bottom: 30px; font-size: 12px; }
                .info-table td { padding: 5px; }
                .info-label { font-weight: bold; color: #555; width: 150px; }
                .students-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
                .students-table th { background-color: #34495e; color: white; padding: 8px; text-align: left; font-size: 13px; }
                .students-table td { padding: 8px; border-bottom: 1px solid #ddd; font-size: 12px; }
                .students-table tr:nth-child(even) { background-color: #f9f9f9; }
                .footer { text-align: center; font-size: 10px; color: #7f8c8d; border-top: 1px solid #eee; padding-top: 10px; margin-top: 50px; }
            ',
            'methods' => [ 
                'SetHeader' => ['Reporte Oficial de Sesión Académica'],
                'SetFooter' => ['Generado el: {DATE j-m-Y H:i} || Página {PAGENO} de {nb}'],
            ]
        ]);

        // 4. Retornar el archivo PDF generado
        return $pdf->render();
    }

}
