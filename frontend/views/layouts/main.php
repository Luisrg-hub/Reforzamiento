<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use common\models\PerfilAlumno;
use common\models\PerfilDocente;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>
<header>

    <?php
    NavBar::begin([
    'brandLabel' => 'Asesorías ITSVA',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top shadow',
    ],
]);

// 1. Botones que ven TODOS (incluso sin iniciar sesión)
$menuItems = [
    ['label' => 'Inicio', 'url' => ['/site/index']],
];

// 2. Lógica para mostrar menús dependiendo de quién es
if (Yii::$app->user->isGuest) {
    // SI NO HAY SESIÓN INICIADA
    $menuItems[] = ['label' => 'Registrarse', 'url' => ['/site/signup']];
    $menuItems[] = ['label' => 'Iniciar Sesión', 'url' => ['/site/login']];
} else {
    // SI YA INICIÓ SESIÓN
    $userId = Yii::$app->user->id;

    // Verificamos si es Alumno
    $esAlumno = PerfilAlumno::find()->where(['id_usuario' => $userId])->exists();
    
    // Verificamos si es Docente
    $esDocente = PerfilDocente::find()->where(['id_usuario' => $userId])->exists();

    if ($esAlumno) {
        // MENÚ EXCLUSIVO PARA ALUMNOS
        $menuItems[] = ['label' => 'Catálogo de sesiones de reforzamiento', 'url' => ['/sesion/catalogo']];
    } elseif ($esDocente) {
        // MENÚ EXCLUSIVO PARA DOCENTES
        $menuItems[] = ['label' => 'Mi horario', 'url' => ['/disponibilidad/index']];
        $menuItems[] = ['label' => 'Mis Sesiones', 'url' => ['/sesion/index']];
    }

    // Botón para cerrar sesión (Lo ven ambos)
    $menuItems[] = '<li class="nav-item">'
        . Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
        . Html::submitButton(
            'Cerrar Sesión (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link nav-link logout text-decoration-none']
        )
        . Html::endForm()
        . '</li>';
}

echo Nav::widget([
    'options' => ['class' => 'navbar-nav ms-auto'],
    'items' => $menuItems,
]);

NavBar::end();
?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-end"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
