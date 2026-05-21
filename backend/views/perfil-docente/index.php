<?php

use common\models\PerfilDocente;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\PerfilDocenteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Docentes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perfil-docente-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear cuenta de Docente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_usuario',
            'nombre',
            'apellido_paterno',
            'apellido_materno',
            'telefono',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, PerfilDocente $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_usuario' => $model->id_usuario]);
                 }
            ],
        ],
    ]); ?>


</div>
