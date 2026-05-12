<?php

namespace frontend\models;

use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Sesion;
use common\models\Asignacion;


/**
 * SesionSearch represents the model behind the search form of `common\models\Sesion`.
 */
class SesionSearch extends Sesion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_asignacion', 'duracion', 'estado'], 'integer'],
            [['fecha', 'hora_inicio', 'tema'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Sesion::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_asignacion' => $this->id_asignacion,
            'fecha' => $this->fecha,
            'hora_inicio' => $this->hora_inicio,
            'duracion' => $this->duracion,
            'estado' => $this->estado,
        ]);

                // Buscamos el ID de las asignaciones que pertenecen al usuario actual
        $asignacionesId = Asignacion::find()
            ->select('id')
            ->where(['id_docente' => Yii::$app->user->id])
            ->column();

        // Filtramos las sesiones para que solo muestre las que coincidan con esas IDs
        $query->andWhere(['id_asignacion' => $asignacionesId]);

        return $dataProvider;
    }
}
