<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "perfil_alumno".
 *
 * @property int $id_usuario
 * @property string $matricula
 * @property string $nombre
 * @property string $apellido_paterno
 * @property string $apellido_materno
 * @property int $id_carrera
 */
class PerfilAlumno extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'perfil_alumno';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_usuario', 'matricula', 'nombre', 'apellido_paterno', 'apellido_materno', 'id_carrera'], 'required'],
            [['id_usuario', 'id_carrera'], 'integer'],
            [['matricula'], 'string', 'max' => 20],
            [['nombre', 'apellido_paterno', 'apellido_materno'], 'string', 'max' => 100],
            [['matricula'], 'unique'],
            [['id_usuario'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'matricula' => 'Matricula',
            'nombre' => 'Nombre',
            'apellido_paterno' => 'Apellido Paterno',
            'apellido_materno' => 'Apellido Materno',
            'id_carrera' => 'Id Carrera',
        ];
    }

}
