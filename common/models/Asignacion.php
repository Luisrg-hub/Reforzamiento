<?php

namespace common\models;
use common\models\PerfilDocente;
use common\models\Asignatura;
use Yii;

/**
 * This is the model class for table "asignacion".
 *
 * @property int $id
 * @property int $id_docente
 * @property int $id_asignatura
 * @property string $periodo
 */
class Asignacion extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asignacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_docente', 'id_asignatura',], 'required'],
            [['id_docente', 'id_asignatura'], 'integer'],
            [['periodo'], 'string', 'max' => 50],
            [['id_docente', 'id_asignatura'], 'unique', 
            'targetAttribute' => ['id_docente', 'id_asignatura'], 
            'message' => 'Error: Este docente ya tiene asignada esta asignatura.'
        ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_docente' => 'Id Docente',
            'id_asignatura' => 'Id Asignatura',
            'periodo' => 'Periodo',
        ];
    }
    /**
     * Relación con el Perfil del Docente
     */
    public function getPerfilDocente()
    {
        // Le decimos que busque en PerfilDocente donde su 'id_usuario' coincida con el 'id_docente' de esta asignación
        return $this->hasOne(PerfilDocente::class, ['id_usuario' => 'id_docente']);
    }

    /**
     * Relación con la Asignatura (Materia)
     */
    public function getAsignatura()
    {
        // Le decimos que busque en Asignatura donde su 'id' coincida con el 'id_asignatura' de esta asignación
        return $this->hasOne(Asignatura::class, ['id' => 'id_asignatura']);
    }

}
