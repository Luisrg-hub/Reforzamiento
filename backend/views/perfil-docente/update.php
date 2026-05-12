<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\PerfilDocente $model */

$this->title = 'Update Perfil Docente: ' . $model->id_usuario;
$this->params['breadcrumbs'][] = ['label' => 'Perfil Docentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_usuario, 'url' => ['view', 'id_usuario' => $model->id_usuario]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="perfil-docente-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'user' => $user,
    ]) ?>

</div>
