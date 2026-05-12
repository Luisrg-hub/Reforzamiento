<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Asignatura $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Asignaturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="asignatura-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'nombre',
        
        // --- CAMBIO EN EL ATRIBUTO ESTADO ---
        [
            'attribute' => 'estado',
            'format' => 'raw',
            'value' => function ($model) {
                return $model->estado == 1 
                    ? '<span style="background-color: #28a745; color: white; padding: 4px 8px; border-radius: 4px; font-weight: bold;">Activa</span>' 
                    : '<span style="background-color: #dc3545; color: white; padding: 4px 8px; border-radius: 4px; font-weight: bold;">Inactiva</span>';
            },
        ],
        // ------------------------------------
    ],
]) ?>

</div>
