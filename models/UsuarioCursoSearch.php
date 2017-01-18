<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UsuarioCurso;

/**
 * UsuarioCursoSearch represents the model behind the search form of `app\models\UsuarioCurso`.
 */
class UsuarioCursoSearch extends UsuarioCurso
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'usuario', 'curso'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = UsuarioCurso::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'usuario' => $this->usuario,
            'curso' => $this->curso,
        ]);

        return $dataProvider;
    }
}
