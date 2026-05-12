<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Asignacion;
use common\models\Disponibilidad;

/** @var yii\web\View $this */
/** @var common\models\Sesion $model */
/** @var yii\widgets\ActiveForm $form */

// 1. Obtenemos las asignaciones del maestro (Materia)
$misAsignaciones = Asignacion::find()->where(['id_docente' => Yii::$app->user->id])->all();
$dataAsignaciones = ArrayHelper::map($misAsignaciones, 'id', function($model) {
    return $model->asignatura->nombre;
});

// 2. Obtenemos LOS BLOQUES DE DISPONIBILIDAD del maestro actual
$misBloques = Disponibilidad::find()->where(['id_docente' => Yii::$app->user->id])->all();

// Creamos la lista desplegable. El valor que se guardará en sesión será la 'hora_inicio'
$dataDisponibilidad = ArrayHelper::map($misBloques, 'hora_inicio', function($model) {
    return $model->dia . " de " . $model->hora_inicio . " a " . $model->hora_cierre;
});
?>

<div class="sesion-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_asignacion')->dropDownList($dataAsignaciones, [
        'prompt' => 'Seleccione la materia...'
    ]) ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'fecha')->textInput(['type' => 'date', 'min' => date('Y-m-d')]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'hora_inicio')->dropDownList($dataDisponibilidad, [
                'prompt' => 'Seleccione un bloque de su horario...'
            ])->label('Hora de la Sesión (Basado en su Disponibilidad)') ?>
        </div>
    </div>

    <?= $form->field($model, 'tema')->textarea([
        'rows' => 3, 
        'placeholder' => 'Breve descripción del tema a tratar en el reforzamiento'
    ])->label('Tema a tratar en la sesión') ?>

    <div class="form-group mt-3">
        <?= Html::submitButton('Agendar Sesión', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>