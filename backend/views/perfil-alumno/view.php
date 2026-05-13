<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\PerfilAlumno $model */

$this->title = $model->id_usuario;
$this->params['breadcrumbs'][] = ['label' => 'Perfil Alumnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="perfil-alumno-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_usuario' => $model->id_usuario], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_usuario' => $model->id_usuario], [
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
            'id_usuario',
            'matricula',
            'nombre',
            'apellido_paterno',
            'apellido_materno',
            'id_carrera',
        ],
    ]) ?>

</div>
