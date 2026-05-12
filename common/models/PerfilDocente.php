<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "perfil_docente".
 *
 * @property int $id_usuario
 * @property string $nombre
 * @property string $apellido_paterno
 * @property string $apellido_materno
 * @property string|null $telefono
 */
class PerfilDocente extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'perfil_docente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['telefono'], 'default', 'value' => null],
            [['nombre', 'apellido_paterno', 'apellido_materno'], 'required'],
            [['id_usuario'], 'integer'],
            [['nombre', 'apellido_paterno', 'apellido_materno'], 'string', 'max' => 100],
            [['telefono'], 'string', 'max' => 20],
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
            'nombre' => 'Nombre',
            'apellido_paterno' => 'Apellido Paterno',
            'apellido_materno' => 'Apellido Materno',
            'telefono' => 'Telefono',
        ];
    }

}
