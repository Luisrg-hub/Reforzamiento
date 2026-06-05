<?php

use common\models\Sesion;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var frontend\models\SesionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Mis sesiones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sesion-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear una nueva sesión', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        [
            'label' => 'Materia',
            'value' => function($model) {
                return $model->asignacion->asignatura->nombre;
            }
        ],
        [
        'attribute' => 'fecha',
        // Cambiamos el cuadro de texto simple por un selector de fecha nativo de HTML5
        'filter' => \yii\helpers\Html::activeInput('date', $searchModel, 'fecha', [
            'class' => 'form-control'
        ]),
        'value' => function($model) {
            // Esto mantiene tu formato visual bonito en la tabla
            return Yii::$app->formatter->asDate($model->fecha, 'medium'); 
        }
        ],
        [
        'attribute' => 'hora_inicio',
        // Cambiamos el cuadro de texto por un selector de hora nativo de HTML5
        'filter' => \yii\helpers\Html::activeInput('time', $searchModel, 'hora_inicio', [
            'class' => 'form-control'
        ]),
        'value' => function($model) {
            // Mantiene el formato visual bonito de 12 horas (ej. 2:00 PM) en la tabla
            return Yii::$app->formatter->asTime($model->hora_inicio, 'short'); 
        }
        ],
        

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>


</div>
