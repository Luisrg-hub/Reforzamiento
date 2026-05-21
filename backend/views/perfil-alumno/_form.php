<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper; 
use common\models\Carrera;
?>

<div class="perfil-alumno-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="card mb-4" style="border: 1px solid #ccc; border-radius: 5px;">
        <div class="card-header" style="background-color: #2c2c2c; color: white; padding: 10px 15px; border-radius: 5px 5px 0 0;">
            Datos de cuenta de usuario
        </div>
        <div class="card-body" style="padding: 20px;">
            <?= $form->field($modelUser, 'username')->textInput(['maxlength' => true])->label('Nombre de usuario') ?>
            <?= $form->field($modelUser, 'email')->textInput(['maxlength' => true])->label('Correo electrónico') ?>
            <?= $form->field($modelUser, 'password')->passwordInput(['maxlength' => true])->label('Contraseña') ?>
        </div>
    </div>

    <div class="card mb-4" style="border: 1px solid #5bc0de; border-radius: 5px;">
        <div class="card-header" style="background-color: #5bc0de; color: white; padding: 10px 15px; border-radius: 5px 5px 0 0;">
            Datos Personales del Alumno
        </div>
        <div class="card-body" style="padding: 20px;">
            <?= $form->field($model, 'matricula')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true, 'readonly' => !$model->isNewRecord]) ?>
            <?= $form->field($model, 'apellido_paterno')->textInput(['maxlength' => true, 'readonly' => !$model->isNewRecord]) ?>
            <?= $form->field($model, 'apellido_materno')->textInput(['maxlength' => true, 'readonly' => !$model->isNewRecord]) ?>
            <?php 
            // 1. Obtener los datos de la tabla 'carrera' y armar la lista
            // IMPORTANTE: Cambia 'id' y 'nombre' por los nombres exactos de tus columnas en la tabla carrera
            $listaCarreras = ArrayHelper::map(Carrera::find()->all(), 'id', 'nombre'); 
            ?>

            <?= $form->field($model, 'id_carrera')->dropDownList(
                $listaCarreras, 
                ['prompt' => '-- Seleccione una carrera --']
            )->label('Ingeniería') ?>
            </div>
    </div>

    <div class="form-group mt-3">
        <?= Html::submitButton('Crear cuenta de alumno', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>