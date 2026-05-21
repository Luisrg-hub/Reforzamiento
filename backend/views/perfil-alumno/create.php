<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\PerfilAlumno $model */

$this->title = 'Nuevo Alumno';
$this->params['breadcrumbs'][] = ['label' => 'Perfil Alumnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perfil-alumno-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelUser' => $modelUser,
    ]) ?>

</div>
