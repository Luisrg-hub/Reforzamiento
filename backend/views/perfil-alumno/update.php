<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\PerfilAlumno $model */

$this->title = 'Update Perfil Alumno: ' . $model->id_usuario;
$this->params['breadcrumbs'][] = ['label' => 'Perfil Alumnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_usuario, 'url' => ['view', 'id_usuario' => $model->id_usuario]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="perfil-alumno-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
