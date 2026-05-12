<?php
use yii\bootstrap5\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $sesion common\models\Sesion */
/* @var $dataProvider yii\data\ActiveDataProvider */

// Configuramos el título y el menú superior (breadcrumbs)
$this->title = 'Alumnos Inscritos';
$this->params['breadcrumbs'][] = ['label' => 'Mis Sesiones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Sesión #' . $sesion->id, 'url' => ['view', 'id' => $sesion->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sesion-lista-inscritos">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="alert alert-info">
        <strong>Tema de la asesoría:</strong> <?= Html::encode($sesion->tema) ?> <br>
        <strong>Fecha:</strong> <?= Html::encode($sesion->fecha) ?> a las <?= Html::encode($sesion->hora_inicio) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => 'Mostrando {begin}-{end} de {totalCount} alumnos inscritos.',
        'emptyText' => 'Aún no hay alumnos inscritos a esta asesoría.',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'], // Muestra el número 1, 2, 3...

            'matricula',
            'nombre',
            'apellido_paterno',
            'apellido_materno',

            // Si quisieras, podrías agregar un botón aquí para "Expulsar/Quitar" a un alumno de la clase en un futuro
        ],
    ]); ?>
</div>