<?php

use common\models\Asignatura;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\AsignaturaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Asignaturas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asignatura-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Añadir Asignatura', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            
            
            // --- CAMBIO EN LA COLUMNA ESTADO ---
            [
                'attribute' => 'estado',
                'format' => 'raw', // Permite inyectar código HTML (las etiquetas de color)
                'value' => function ($model) {
                    if ($model->estado == 1) {
                        // Etiqueta verde
                        return '<span style="background-color: #28a745; color: white; padding: 4px 8px; border-radius: 4px; font-weight: bold;">Activa</span>';
                    } else {
                        // Etiqueta roja
                        return '<span style="background-color: #dc3545; color: white; padding: 4px 8px; border-radius: 4px; font-weight: bold;">Inactiva</span>';
                    }
                },
                // Cambia el cuadro de texto del buscador por un menú desplegable
                'filter' => [1 => 'Activa', 0 => 'Inactiva'],
            ],
            // -----------------------------------

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
