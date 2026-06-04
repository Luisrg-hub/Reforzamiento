<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "alumno_sesion".
 *
 * @property int $id_sesion
 * @property int $id_alumno
 */
class AlumnoSesion extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alumno_sesion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_sesion', 'id_alumno'], 'required'],
            [['id_sesion', 'id_alumno'], 'integer'],
            [['id_sesion', 'id_alumno'], 'unique', 'targetAttribute' => ['id_sesion', 'id_alumno']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_sesion' => 'Id Sesion',
            'id_alumno' => 'Id Alumno',
        ];
    }
    public function getPerfilAlumno()
    {
        // Cada registro intermedio pertenece a un PerfilAlumno uniendo id_usuario con id_alumno
        return $this->hasOne(PerfilAlumno::class, ['id_usuario' => 'id_alumno']);
    }

}
