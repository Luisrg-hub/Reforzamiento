<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

   <?php $form = ActiveForm::begin(); ?>

    <div class="card">
        <div class="card-header">Datos de Cuenta de usuario</div>
        <div class="card-body">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-header">Datos Personales del Administrador</div>
        <div class="card-body">
            <?= $form->field($perfil, 'nombre')->textInput(['maxlength' => true]) ?>
            <?= $form->field($perfil, 'apellido_paterno')->textInput(['maxlength' => true]) ?>
            <?= $form->field($perfil, 'apellido_materno')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group mt-3">
        <?= Html::submitButton('Confirmar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
