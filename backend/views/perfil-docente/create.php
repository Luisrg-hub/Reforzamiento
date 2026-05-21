<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\PerfilDocente $model */


$this->title = 'Nuevo Docente';
$this->params['breadcrumbs'][] = ['label' => 'Perfil Docentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perfil-docente-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'user' => $user,
    ]) ?>

</div>
