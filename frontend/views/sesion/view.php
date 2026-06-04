<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Sesion $model */

$this->title = 'Datos de la sesión';
$this->params['breadcrumbs'][] = ['label' => 'Sesions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sesion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Ver Lista de Inscritos', ['lista-inscritos', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-file"></span> Descargar Reporte PDF', 
            ['reporte-pdf', 'id' => $model->id], 
            [
                'class' => 'btn btn-danger', // Color rojo característico de los PDFs
                'target' => '_blank', // Abre en pestaña nueva si se prefiere visualizar antes
                'data-pjax' => '0',   // Crucial: Desactiva PJAX para que la descarga funcione
            ]
        ) ?>
    </p>

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        // 'id',
        [
            'label' => 'Materia',
            'value' => function($model) {
                return $model->asignacion->asignatura->nombre;
            }
        ],
        'fecha:date',
        
        // La hora de inicio ahora guarda el bloque de disponibilidad
        [
            'label' => 'Horario de la Sesión',
            'value' => $model->hora_inicio, 
        ],
        'tema',
    ],
]) ?>

</div>
