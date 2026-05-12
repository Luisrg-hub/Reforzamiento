<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "evidencia".
 *
 * @property int $id
 * @property int $id_sesion
 * @property string $nombre_archivo
 * @property string $ruta
 */
class Evidencia extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'evidencia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_sesion', 'nombre_archivo', 'ruta'], 'required'],
            [['id_sesion'], 'integer'],
            [['nombre_archivo', 'ruta'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_sesion' => 'Id Sesion',
            'nombre_archivo' => 'Nombre Archivo',
            'ruta' => 'Ruta',
        ];
    }

}
