<?php

use common\models\Sesion;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\SesionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sesiones actuales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sesion-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        [
            'label' => 'Docente',
            'value' => function($model) {
                // Viajamos por las relaciones para sacar el nombre del maestro
                $docente = $model->asignacion->perfilDocente;
                return $docente ? $docente->nombre . ' ' . $docente->apellido_paterno : 'Desconocido';
            }
        ],
        [
            'label' => 'Materia',
            'value' => function($model) {
                return $model->asignacion->asignatura->nombre;
            }
        ],
        'fecha:date',
        'hora_inicio:time',

        [
            'class' => 'yii\grid\ActionColumn',
            // El admin conserva los botones de Ver, Editar y Borrar
            'template' => '{view} {update} {delete}', 
        ],
    ],
]); ?>


</div>
