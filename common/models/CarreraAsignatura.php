<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "carrera_asignatura".
 *
 * @property int $id_carrera
 * @property int $id_asignatura
 */
class CarreraAsignatura extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carrera_asignatura';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_carrera', 'id_asignatura'], 'required'],
            [['id_carrera', 'id_asignatura'], 'integer'],
            [['id_carrera', 'id_asignatura'], 'unique', 'targetAttribute' => ['id_carrera', 'id_asignatura']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_carrera' => 'Id Carrera',
            'id_asignatura' => 'Id Asignatura',
        ];
    }

}
