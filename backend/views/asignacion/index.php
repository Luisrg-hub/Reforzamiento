<?php


use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\AsignacionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Asignaciones a docentes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asignacion-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Asignar a un docente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        // Mostramos el nombre del docente usando la relación
        [
            'attribute' => 'id_docente',
            'value' => function($model) {
                return $model->perfilDocente->nombre . ' ' . $model->perfilDocente->apellido_paterno;
            },
            'label' => 'Docente',
        ],
        
        // Mostramos el nombre de la asignatura
        [
            'attribute' => 'id_asignatura',
            'value' => 'asignatura.nombre',
            'label' => 'Asignatura',
        ],

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>


</div>
