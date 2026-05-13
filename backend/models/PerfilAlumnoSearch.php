<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PerfilAlumno;

/**
 * PerfilAlumnoSearch represents the model behind the search form of `common\models\PerfilAlumno`.
 */
class PerfilAlumnoSearch extends PerfilAlumno
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_carrera'], 'integer'],
            [['matricula', 'nombre', 'apellido_paterno', 'apellido_materno'], 'safe'],
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
        $query = PerfilAlumno::find();

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
            'id_usuario' => $this->id_usuario,
            'id_carrera' => $this->id_carrera,
        ]);

        $query->andFilterWhere(['like', 'matricula', $this->matricula])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellido_paterno', $this->apellido_paterno])
            ->andFilterWhere(['like', 'apellido_materno', $this->apellido_materno]);

        return $dataProvider;
    }
}
