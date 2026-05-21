<?php
use yii\helpers\Html;
use yii\grid\GridView;

/**  @var $this yii\web\View */
/**  @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Catálogo de Asesorías';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sesion-catalogo">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>Selecciona la asesoría a la que deseas asistir:</p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Materia',
                'value' => function($model) {
                    return $model->asignacion->asignatura->nombre;
                }
            ],
            [
                'label' => 'Docente',
                'value' => function($model) {
                    return $model->asignacion->perfilDocente->nombre . ' ' . $model->asignacion->perfilDocente->apellido_paterno;
                }
            ],
            'fecha:date',
            'hora_inicio:time',
            'tema',
            
            // Botón de Inscripción
            [
            'format' => 'raw', // Permite inyectar HTML directamente
            'value' => function ($model) {
                // 1. Verificamos si hay un registro en la tabla intermedia para este alumno y esta sesión
                $estaInscrito = Yii::$app->db->createCommand(
                    'SELECT 1 FROM alumno_sesion WHERE id_sesion = :sesion AND id_alumno = :alumno'
                )->bindValues([
                    ':sesion' => $model->id,
                    ':alumno' => Yii::$app->user->id // El ID del alumno logueado
                ])->queryScalar();

                // 2. Cambiamos la apariencia del botón según el resultado
                if ($estaInscrito) {
                    // Botón verde, deshabilitado y con texto diferente
                    return Html::button('Ya estás inscrito', [
                        'class' => 'btn btn-success disabled',
                        'style' => 'opacity: 0.8; cursor: not-allowed;'
                    ]);
                } else {
                    // Botón normal azul para inscribirse
                    return Html::a('Inscribirse', ['inscribir', 'id_sesion' => $model->id], [
                        'class' => 'btn btn-primary'
                    ]);
                }
            }
        ],
        ],
    ]); ?>

</div>