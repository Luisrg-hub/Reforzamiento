<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\PerfilDocente $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="perfil-docente-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="card mb-3">
        <div class="card-header bg-dark text-white">Datos de cuenta de usuario</div>
        <div class="card-body">
            <?= $form->field($user, 'username')->textInput(['maxlength' => true])->label('Nombre de usuario') ?>
            <?= $form->field($user, 'email')->textInput(['maxlength' => true])->label('Correo electrónico') ?>
            <?= $form->field($user, 'password')->passwordInput(['maxlength' => true])->label('Contraseña') ?>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-info text-white">Datos Personales del Docente</div>
        <div class="card-body">
            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'apellido_paterno')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'apellido_materno')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'telefono')->textInput(['maxlength' => true])->label('Teléfono') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Dar de Alta Docente', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>