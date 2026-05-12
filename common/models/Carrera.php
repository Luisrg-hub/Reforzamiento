<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "carrera".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property Asignatura[] $asignaturas
 * @property Asignatura[] $asignaturas0
 * @property CarreraAsignatura[] $carreraAsignaturas
 * @property PerfilAlumno[] $perfilAlumnos
 */
class Carrera extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carrera';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * Gets query for [[Asignaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignaturas()
    {
        return $this->hasMany(Asignatura::class, ['id_carrera' => 'id']);
    }

    /**
     * Gets query for [[Asignaturas0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignaturas0()
    {
        return $this->hasMany(Asignatura::class, ['id' => 'id_asignatura'])->viaTable('carrera_asignatura', ['id_carrera' => 'id']);
    }

    /**
     * Gets query for [[CarreraAsignaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarreraAsignaturas()
    {
        return $this->hasMany(CarreraAsignatura::class, ['id_carrera' => 'id']);
    }

    /**
     * Gets query for [[PerfilAlumnos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerfilAlumnos()
    {
        return $this->hasMany(PerfilAlumno::class, ['id_carrera' => 'id']);
    }

}
