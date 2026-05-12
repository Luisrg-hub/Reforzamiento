<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Carrera;

/** @var yii\web\View $this */
/** @var common\models\Asignatura $model */
/** @var yii\widgets\ActiveForm $form */

// Obtenemos las carreras para el dropdown
$carreras = Carrera::find()->all();
$dataCarreras = ArrayHelper::map($carreras, 'id', 'nombre');
?>

<div class="asignatura-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_carrera')->dropDownList($dataCarreras, [
        'prompt' => 'Seleccione la carrera a la que pertenece...'
    ])->label('Carrera') ?>

    <?= $form->field($model, 'estado')->dropDownList([
        1 => 'Activa (Ofertada este semestre)',
        0 => 'Inactiva'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
