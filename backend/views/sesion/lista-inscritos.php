<?php
use yii\bootstrap5\Html;
use yii\grid\GridView;

$this->title = 'Alumnos Inscritos';
$this->params['breadcrumbs'][] = ['label' => 'Sesiones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $sesion->id, 'url' => ['view', 'id' => $sesion->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sesion-lista-inscritos">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Inscribir Alumno Manualmente', ['inscribir-alumno', 'id' => $sesion->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'matricula',
            'nombre',
            'apellido_paterno',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Acciones',
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function ($url, $model) use ($sesion) {
                        return Html::a('Quitar', ['quitar-alumno', 'id_sesion' => $sesion->id, 'id_alumno' => $model->id_usuario], [
                            'class' => 'btn btn-sm btn-danger',
                            'data' => [
                                'confirm' => '¿Quitar definitivamente a este alumno de la sesión?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
</div>