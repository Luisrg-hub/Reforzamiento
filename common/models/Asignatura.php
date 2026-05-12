<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "asignatura".
 *
 * @property int $id
 * @property string $nombre
 * @property int|null $id_carrera
 * @property int|null $estado
 *
 * @property Asignacion[] $asignacions
 * @property Carrera $carrera
 * @property CarreraAsignatura[] $carreraAsignaturas
 * @property Carrera[] $carreras
 */
class Asignatura extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asignatura';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_carrera'], 'default', 'value' => null],
            [['estado'], 'default', 'value' => 1],
            [['nombre'], 'required'],
            [['id_carrera', 'estado'], 'integer'],
            [['nombre'], 'string', 'max' => 255],
            [['id_carrera'], 'exist', 'skipOnError' => true, 'targetClass' => Carrera::class, 'targetAttribute' => ['id_carrera' => 'id']],
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
            'id_carrera' => 'Id Carrera',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[Asignacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignacions()
    {
        return $this->hasMany(Asignacion::class, ['id_asignatura' => 'id']);
    }

    /**
     * Gets query for [[Carrera]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarrera()
    {
        return $this->hasOne(Carrera::class, ['id' => 'id_carrera']);
    }

    /**
     * Gets query for [[CarreraAsignaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarreraAsignaturas()
    {
        return $this->hasMany(CarreraAsignatura::class, ['id_asignatura' => 'id']);
    }

    /**
     * Gets query for [[Carreras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarreras()
    {
        return $this->hasMany(Carrera::class, ['id' => 'id_carrera'])->viaTable('carrera_asignatura', ['id_asignatura' => 'id']);
    }

}
