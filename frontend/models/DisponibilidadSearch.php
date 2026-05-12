<?php

namespace frontend\models;
use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Disponibilidad;

/**
 * DisponibilidadSearch represents the model behind the search form of `common\models\Disponibilidad`.
 */
class DisponibilidadSearch extends Disponibilidad
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_docente'], 'integer'],
            [['dia', 'hora_inicio', 'hora_cierre'], 'safe'],
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
        $query = Disponibilidad::find();

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

        
        $query->andWhere(['id_docente' => Yii::$app->user->id]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_docente' => $this->id_docente,
            'hora_inicio' => $this->hora_inicio,
            'hora_cierre' => $this->hora_cierre,
        ]);

        $query->andFilterWhere(['like', 'dia', $this->dia]);

        return $dataProvider;
    }
}
