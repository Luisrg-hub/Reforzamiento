<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Disponibilidad $model */

$this->title = 'Actualizar horario';
$this->params['breadcrumbs'][] = ['label' => 'Disponibilidads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="disponibilidad-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
