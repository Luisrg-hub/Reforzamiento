<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;       
use common\models\PerfilDocente;
use common\models\Asignatura;

/** @var yii\web\View $this */
/** @var common\models\Asignacion $model */
/** @var yii\widgets\ActiveForm $form */

// MODIFICACIÓN CLAVE: Agregamos el ->where(['estado' => 1])
// Esto extrae solo las materias que el admin marcó como Activas
$materiasActivas = Asignatura::find()
    ->where(['estado' => 1]) 
    ->orderBy('nombre ASC')
    ->all();

    $dataAsignaturas = ArrayHelper::map($materiasActivas, 'id', function($model) {
    return $model->nombre . " (" . ($model->carrera ? $model->carrera->nombre : 'Sin carrera') . ")";
});
?>

<div class="asignacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="card shadow-sm">
        <div class="card-body">
            
            <?= $form->field($model, 'id_docente')->dropDownList(
                ArrayHelper::map(PerfilDocente::find()->all(), 'id_usuario', function($model) {
                    return $model->nombre . ' ' . $model->apellido_paterno;
                }),
                ['prompt' => 'Seleccione un Docente...']
            ) ->label('Docente')?>

            <?= $form->field($model, 'id_asignatura')->dropDownList($dataAsignaturas, [
                'prompt' => 'Seleccione una materia activa...'
            ])->label('Asignatura correspondiente') ?>

            <div class="form-group mt-3">
                <?= Html::submitButton('Guardar Asignación', ['class' => 'btn btn-success']) ?>
            </div>

        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
