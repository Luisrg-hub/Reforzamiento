<?php

namespace common\models;
use common\models\Asignacion;

use Yii;

/**
 * This is the model class for table "sesion".
 *
 * @property int $id
 * @property int $id_asignacion
 * @property string $fecha
 * @property string $hora_inicio
 * @property int $duracion
 * @property string $tema
 * @property int|null $estado
 */
class Sesion extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sesion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estado'], 'default', 'value' => 1],
            [['id_asignacion', 'fecha', 'hora_inicio'], 'required'],
            [['id_asignacion', 'duracion', 'estado'], 'integer'],
            [['fecha', 'hora_inicio'], 'safe'],
            [['tema'], 'string', 'max' => 255],
            ['fecha', 'compare', 'compareValue' => date('Y-m-d'), 'operator' => '>=', 'message' => 'La fecha no puede ser en el pasado.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_asignacion' => 'Id Asignacion',
            'fecha' => 'Fecha',
            'hora_inicio' => 'Hora Inicio',
            'duracion' => 'Duracion',
            'tema' => 'Tema',
            'estado' => 'Estado',
        ];
    }
    /**
     * Relación con la tabla Asignacion
     */
    
    public function getAsignacion()
    {
        // La sesión se conecta a la asignación a través de id_asignacion
        return $this->hasOne(Asignacion::class, ['id' => 'id_asignacion']);
    }

    public function getAlumnoSesiones()
    {
        // Relación con la tabla intermedia que une alumnos con la asignatura o sesión
        return $this->hasMany(AlumnoSesion::class, ['id_sesion' => 'id']);
}

}
