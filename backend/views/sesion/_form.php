<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm; // <- ¡Esta línea es vital para que funcione ActiveForm!
use yii\helpers\ArrayHelper;
use common\models\Asignacion;

/** @var yii\web\View $this */
/** @var common\models\Sesion $model */
/** @var yii\widgets\ActiveForm $form */

// El admin necesita ver la lista completa de asignaciones para que el campo no dé error
$todasLasAsignaciones = Asignacion::find()->all();
$dataAsignaciones = ArrayHelper::map($todasLasAsignaciones, 'id', function($model) {
    return $model->perfilDocente->nombre . ' - ' . $model->asignatura->nombre;
});
?>

<div class="sesion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_asignacion')->dropDownList($dataAsignaciones, [
        'disabled' => true 
    ])->label('Asignación (Dueño de la sesión)') ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'fecha')->textInput(['type' => 'date']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'hora_inicio')->textInput(['type' => 'time']) ?>
        </div>
    </div>

    <?= $form->field($model, 'tema')->textarea(['rows' => 3])->label('Tema a tratar') ?>

    <div class="form-group mt-3">
        <?= Html::submitButton('Guardar Cambios', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

