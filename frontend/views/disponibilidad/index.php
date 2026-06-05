<?php

use common\models\Disponibilidad;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var frontend\models\DisponibilidadSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Disponibilidad';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disponibilidad-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Registrar mi horario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'dia',
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
        [
        'attribute' => 'hora_cierre',
        // Cambiamos el cuadro de texto por un selector de hora nativo de HTML5
        'filter' => \yii\helpers\Html::activeInput('time', $searchModel, 'hora_cierre', [
            'class' => 'form-control'
        ]),
        'value' => function($model) {
            // Mantiene el formato visual bonito de 12 horas (ej. 2:00 PM) en la tabla
            return Yii::$app->formatter->asTime($model->hora_cierre, 'short'); 
        }
        ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Disponibilidad $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
