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
            'attribute' => 'id_asignacion',
            'label' => 'Materia',
            'value' => function($model) {
                return $model->asignacion->asignatura->nombre;
            }
        ],
        'fecha:date',
        'hora_inicio:time',
        'tema',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>


</div>
