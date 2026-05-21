<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Disponibilidad $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="disponibilidad-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dia')->dropDownList([
        'Lunes' => 'Lunes', 
        'Martes' => 'Martes', 
        'Miércoles' => 'Miércoles', 
        'Jueves' => 'Jueves', 
        'Viernes' => 'Viernes', 
    ], ['prompt' => 'Seleccione el día...']) ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'hora_inicio')->textInput(['type' => 'time']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'hora_cierre')->textInput(['type' => 'time']) ?>
        </div>
    </div>

    <div class="form-group mt-3">
        <?= Html::submitButton('Guardar Horario', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
