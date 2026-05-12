<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\SesionSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="sesion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_asignacion') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'hora_inicio') ?>

    <?= $form->field($model, 'duracion') ?>

    <?php // echo $form->field($model, 'tema') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
