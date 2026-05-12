<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "disponibilidad".
 *
 * @property int $id
 * @property int $id_docente
 * @property string $dia
 * @property string $hora_inicio
 * @property string $hora_cierre
 */
class Disponibilidad extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'disponibilidad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_docente', 'dia', 'hora_inicio', 'hora_cierre'], 'required'],
            [['id_docente'], 'integer'],
            [['hora_inicio', 'hora_cierre'], 'safe'],
            [['dia'], 'string', 'max' => 20],
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
            'dia' => 'Dia',
            'hora_inicio' => 'Hora Inicio',
            'hora_cierre' => 'Hora Cierre',
        ];
    }

}
