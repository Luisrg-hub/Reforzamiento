<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\PerfilDocenteSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="perfil-docente-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_usuario') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'apellido_paterno') ?>

    <?= $form->field($model, 'apellido_materno') ?>

    <?= $form->field($model, 'telefono') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
