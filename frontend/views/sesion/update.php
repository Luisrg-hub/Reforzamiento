<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Sesion $model */

$this->title = 'Update Sesion: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sesions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sesion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
