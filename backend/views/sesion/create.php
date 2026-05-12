<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Sesion $model */

$this->title = 'Crear Sesión';
$this->params['breadcrumbs'][] = ['label' => 'Sesiones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sesion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
