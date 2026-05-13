<?php

use common\models\PerfilAlumno;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\PerfilAlumnoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Perfil Alumnos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perfil-alumno-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear cuenta de Alumno', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_usuario',
            'matricula',
            'nombre',
            'apellido_paterno',
            'apellido_materno',
            'id_carrera',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, PerfilAlumno $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_usuario' => $model->id_usuario]);
                 }
            ],
        ],
    ]); ?>


</div>
