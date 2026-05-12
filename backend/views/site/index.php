<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Sistema de Asesorías de Reforzamiento - ITSVA';
?>



<style>
    /* Reset y variables */
    :root {
        --azul-itsva: #1a3a8f;
        --azul-nav: #1e4db7;
        --gris-fondo: #f0f2f5;
        --blanco: #ffffff;
        --texto-oscuro: #2c2c2c;
        --texto-gris: #555;
        --borde: #dce3ef;
    }

    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap');
    
    body {
        background-color: var(--gris-fondo);
        font-family: 'Montserrat', sans-serif;
        margin: 0;
        padding: 0;
    }

    /* Ocultar el contenido default de Yii2 */
    .site-index .jumbotron,
    .site-index h1,
    .site-index p.lead,
    .site-index .body-content {
        display: none !important;
    }

    /* Contenedor principal de bienvenida */
    .itsva-welcome-wrapper {
        min-height: calc(100vh - 100px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        background-color: var(--gris-fondo);
    }

    .itsva-card {
        background: var(--blanco);
        border-radius: 4px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        max-width: 900px;
        width: 100%;
        padding: 50px 60px 60px 60px;
    }

    /* Sección de logos */
    .itsva-logos {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 30px;
        margin-bottom: 50px;
        flex-wrap: wrap;
    }

    .itsva-logos img {
        height: 70px;
        width: auto;
        object-fit: contain;
    }

    .logo-sep {
        width: 1px;
        height: 60px;
        background: var(--borde);
    }

    /* Logo placeholder con texto cuando no hay imagen */
    .logo-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 70px;
    }

    .logo-tnm {
        /* Tecnológico Nacional de México */
        width: 65px;
        height: 70px;
    }

    .logo-escudo {
        /* Escudo de Yucatán */
        width: 55px;
        height: 70px;
    }

    .logo-yucatan-gov {
        /* Gobierno Yucatán */
        height: 45px;
    }

    .logo-mx {
        /* Gobierno de México */
        margin-left: auto;
        height: 55px;
    }

    .logo-figura {
        /* Figura decorativa */
        height: 90px;
        margin-top: -10px;
    }

    /* Texto de bienvenida */
    .itsva-bienvenida {
        text-align: center;
        margin-bottom: 40px;
    }

    .itsva-bienvenida h2 {
        font-family: 'Montserrat', sans-serif;
        font-size: 26px;
        font-weight: normal;
        color: var(--texto-oscuro);
        margin: 0;
        line-height: 1.5;
    }

    /* Cita motivacional */
    .itsva-cita {
        text-align: center;
        margin-top: 10px;
    }

    .itsva-cita p {
        font-family: 'Montserrat', sans-serif;
        font-style: italic;
        font-size: 17px;
        color: var(--texto-oscuro);
        line-height: 1.7;
        margin: 0;
    }

    /* =========================================================
       ESTILOS PARA LA BARRA DE NAVEGACIÓN DE YII2
       Modifica el navbar existente
       ========================================================= */

    .navbar {
        background-color: var(--azul-itsva) !important;
        border: none !important;
        border-radius: 0 !important;
        margin-bottom: 0 !important;
        min-height: 60px;
    }

    .navbar .navbar-brand,
    .navbar .navbar-nav > li > a {
        color: #ffffff !important;
        text-transform: uppercase;
        font-family: 'Montserrat', sans-serif;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .navbar .navbar-nav > li > a:hover,
    .navbar .navbar-nav > li > a:focus {
        background-color: rgba(255, 255, 255, 0.15) !important;
        color: #ffffff !important;
    }

    .navbar .navbar-nav > li.active > a {
        background-color: rgba(255, 255, 255, 0.2) !important;
        color: #ffffff !important;
    }

    .navbar-toggle .icon-bar {
        background-color: #ffffff !important;
    }

    /* Footer */
    .footer {
        background: var(--gris-fondo);
        border-top: 1px solid var(--borde);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .itsva-card {
            padding: 30px 25px 40px 25px;
        }

        .itsva-bienvenida h2 {
            font-size: 20px;
        }

        .itsva-cita p {
            font-size: 15px;
        }

        .itsva-logos {
            gap: 18px;
            justify-content: center;
        }

        .logo-mx {
            margin-left: 0;
        }
    }
</style>

<div class="itsva-welcome-wrapper">
    <div class="itsva-card">

        <!-- LOGOS INSTITUCIONALES -->
        <!-- 
            INSTRUCCIONES: Reemplaza los src de las etiquetas <img> con las
            rutas reales de tus logos. Puedes colocarlos en:
            frontend/web/images/logos/

            Ejemplo: src="<?= Yii::$app->request->baseUrl ?>/images/logos/tnm.png"
        -->
        <div class="itsva-logos">

            <!-- Logo Tecnológico Nacional de México -->
            <div class="logo-placeholder">
                <img 
                    src="<?= Yii::$app->request->baseUrl ?>/images/logos/tnm.png"
                    alt="Tecnológico Nacional de México"
                    class="logo-tnm"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                />
                <div style="display:none; flex-direction:column; align-items:center; justify-content:center; width:65px; height:70px; border:2px solid #1a3a8f; border-radius:50%; color:#1a3a8f; font-size:9px; font-weight:bold; text-align:center; padding:4px; box-sizing:border-box;">
                    TEC NAL<br>DE MÉX
                </div>
            </div>

            <div class="logo-sep"></div>

            <!-- Escudo de Yucatán -->
            <div class="logo-placeholder">
                <img 
                    src="<?= Yii::$app->request->baseUrl ?>/images/logos/escudo_yucatan.png"
                    alt="Yucatán"
                    class="logo-escudo"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                />
                <div style="display:none; flex-direction:column; align-items:center; justify-content:center; width:55px; height:70px; border:2px solid #888; border-radius:4px; color:#555; font-size:9px; font-weight:bold; text-align:center; padding:4px; box-sizing:border-box;">
                    YUCATÁN
                </div>
            </div>

            <!-- Logo Gobierno Yucatán - Renacimiento Maya -->
            <div class="logo-placeholder">
                <img 
                    src="<?= Yii::$app->request->baseUrl ?>/images/logos/gobierno_yucatan.png"
                    alt="Renacimiento Maya - Yucatán Gobierno del Estado 2024-2030"
                    class="logo-yucatan-gov"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                />
                <div style="display:none; flex-direction:column; align-items:center; justify-content:center; height:45px; color:#8B4513; font-size:10px; font-weight:bold; text-align:center;">
                    RENACIMIENTO MAYA<br>YUCATÁN
                </div>
            </div>

            <!-- Logo Gobierno de México (empujado a la derecha) -->
            <div class="logo-placeholder" style="margin-left:auto;">
                <img 
                    src="<?= Yii::$app->request->baseUrl ?>/images/logos/logo_itsva.png"
                    alt="Gobierno de México"
                    class="logo-mx"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                />
                <div style="display:none; flex-direction:column; align-items:center; justify-content:center; height:55px; color:#555; font-size:9px; font-weight:bold; text-align:center;">
                    GOBIERNO<br>DE MÉXICO
                </div>
            </div>


        </div>
        <!-- /LOGOS -->

        <!-- TEXTO DE BIENVENIDA -->
        <div class="itsva-bienvenida">
            <h2>
                Te damos la bienvenida al<br>
                Sistema de Asesorías de Reforzamiento del ITSVA
            </h2>
        </div>

        <!-- CITA MOTIVACIONAL -->
        <div class="itsva-cita">
            <p>
                "El éxito es la suma de pequeños esfuerzos repetidos día tras día."<br>
                <em>Estamos aquí para apoyarte en tu camino hacia la excelencia académica en el ITSVA.</em>
            </p>
        </div>

    </div>
</div>