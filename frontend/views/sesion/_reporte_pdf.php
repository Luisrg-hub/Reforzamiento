<?php
/** @var common\models\Sesion $model */
?>

<table class="header-table">
    <tr>
        <td>
            <div class="title">REPORTE DETALLADO DE SESIÓN</div>
            <span style="font-size: 11px; color: #7f8c8d;">Control de Asistencia e Inscripciones</span>
        </td>
        <td style="text-align: right; font-weight: bold; color: #e74c3c;">
            ID SESIÓN: #<?= $model->id ?>
        </td>
    </tr>
</table>

<table class="info-table">
    <tr>
        <td class="info-label">Docente:</td>
        <td>
            <?php 
            if ($model->asignacion && $model->asignacion->perfilDocente) {
                $docente = $model->asignacion->perfilDocente;
                echo htmlspecialchars($docente->nombre . ' ' . $docente->apellido_paterno . ' ' . $docente->apellido_materno);
            } else {
                echo 'No asignado';
            }
            ?>
        </td>
        <td class="info-label">Fecha de Sesión:</td>
        <td><?= date('d/m/Y', strtotime($model->fecha)) ?></td>
    </tr>
    <tr>
        <td class="info-label">Asignatura:</td>
        <td>
            <?php 
            if ($model->asignacion && $model->asignacion->asignatura) {
                echo htmlspecialchars($model->asignacion->asignatura->nombre);
            } else {
                echo 'No asignada';
            }
            ?>
        </td>
        <td class="info-label">Fecha de Reporte:</td>
        <td><?= date('d/m/Y H:i:s') ?></td>
    </tr>
</table>

<h3 style="color: #2c3e50; border-bottom: 1px solid #34495e; padding-bottom: 5px;">Alumnos Inscritos al Momento</h3>

<table class="students-table">
    <thead>
        <tr>
            <th style="width: 5%;">#</th>
            <th style="width: 25%;">Matrícula</th>
            <th style="width: 70%;">Nombre Completo del Alumno</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        // Usamos la relación real hacia la tabla intermedia
        $alumnoSesiones = $model->alumnoSesiones; 
        
        if (!empty($alumnoSesiones)): 
            $contador = 1;
            foreach ($alumnoSesiones as $relacion): 
                // Desde la relación intermedia, accedemos al perfil del alumno
                $alumno = $relacion->perfilAlumno; 
        ?>
            <tr>
                <td><?= $contador++ ?></td>
                <td><?= htmlspecialchars($alumno ? $alumno->matricula : 'N/A') ?></td>
                <td>
                    <?= htmlspecialchars($alumno ? $alumno->nombre . ' ' . $alumno->apellido_paterno . ' ' . $alumno->apellido_materno : 'Alumno no encontrado') ?>
                </td>
            </tr>
        <?php 
            endforeach; 
        else: 
        ?>
            <tr>
                <td colspan="3" style="text-align: center; color: #7f8c8d; font-style: italic;">
                    No hay alumnos inscritos en esta sesión actualmente.
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<div class="footer">
    <p>Este documento es un reporte digital del sistema y no requiere firma autógrafa.</p>
</div>