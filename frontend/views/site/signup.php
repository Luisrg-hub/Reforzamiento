<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use common\models\Carrera;
use yii\helpers\ArrayHelper;

$this->title = 'Registro de Alumno';
$this->params['breadcrumbs'][] = $this->title;

// Traemos las carreras de la base de datos para el dropdown
$carreras = Carrera::find()->orderBy('nombre ASC')->all();
$listaCarreras = ArrayHelper::map($carreras, 'id', 'nombre');
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Por favor llena los siguientes campos para crear tu cuenta:</p>

    <div class="row">
        <div class="col-lg-8">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <div class="row">
                <div class="col-md-6">
                    <h4 class="mt-3">Datos de Acceso</h4>
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Nombre de Usuario') ?>
                    <?= $form->field($model, 'email')->label('Correo Institucional') ?>
                    <?= $form->field($model, 'password')->passwordInput()->label('Contraseña') ?>
                </div>
                
                <div class="col-md-6">
                    <h4 class="mt-3">Datos Escolares</h4>
                    <?= $form->field($model, 'matricula')->textInput(['maxlength' => true]) ?>
                    
                    <?= $form->field($model, 'id_carrera')->dropDownList($listaCarreras, [
                        'prompt' => 'Selecciona tu carrera...'
                    ])->label('Carrera') ?>
                </div>
            </div>

            <div class="row">
                <h4 class="mt-3">Datos Personales</h4>
                <div class="col-md-4">
                    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'apellido_paterno')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'apellido_materno')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="form-group mt-4">
                <?= Html::submitButton('Registrarme', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
