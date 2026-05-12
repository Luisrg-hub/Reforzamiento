<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

$this->title = 'Inscribir Alumno';
$this->params['breadcrumbs'][] = ['label' => 'Sesiones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Inscritos', 'url' => ['lista-inscritos', 'id' => $sesion->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="inscribir-alumno-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <label>Buscar Alumno (Nombre o Matrícula)</label>
        
        <?= Select2::widget([
            'name' => 'id_alumno',
            'data' => ArrayHelper::map($alumnos, 'id_usuario', function($model) {
                return $model->nombre . ' ' . $model->apellido_paterno . ' (' . $model->matricula . ')';
            }),
            'options' => ['placeholder' => 'Escribe el nombre del alumno...'],
            'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 1,
            ],
        ]); ?>
    </div>

    <div class="form-group mt-3">
        <?= Html::submitButton('Inscribir Ahora', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Volver', ['lista-inscritos', 'id' => $sesion->id], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>