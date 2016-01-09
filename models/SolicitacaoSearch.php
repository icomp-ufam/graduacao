<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use app\models\Solicitacao;

/**
 * SolicitacaoSearch represents the model behind the search form about `app\models\Solicitacao`.
 */
class SolicitacaoSearch extends Solicitacao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'horasComputadas', 'atividade_id', 'solicitante_id', 'aprovador_id', 'anexo_id'], 'integer'],
            [['descricao', 'dtInicio', 'dtTermino', 'observacoes', 'status', 'solicitante_id'], 'safe'],
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
        $query = Solicitacao::find();

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

        /* grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'dtInicio' => $this->dtInicio,
            'dtTermino' => $this->dtTermino,
            'horasComputadas' => $this->horasComputadas,
            'atividade_id' => $this->atividade_id,
            //'solicitante_id' => $this->solicitante_id,
            'aprovador_id' => $this->aprovador_id,
            'anexo_id' => $this->anexo_id,
        ]);

        $query->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'observacoes', $this->observacoes])
            ->andFilterWhere(['like', 'status', $this->status]);
        */

        /* ********************************************
        * Filtra somente as Solicitacoes feitas
        * pelo Usuario logado no caso de Aluno
        * ****************************************** */
        if(Yii::$app->user->identity->perfil=='Aluno')
        {
            $query->andFilterWhere([
                'solicitante_id' => Yii::$app->user->identity->id,
            ]);

        }

        /* ********************************************
        * Filtra somente as Solicitacoes feitas
        * por Alunos do Curso que o Coordenador logado
        * pertence
        * ****************************************** */
        if(Yii::$app->user->identity->perfil=='Coordenador')
        {
                
            $dataProvider = new SqlDataProvider([
                'sql' => 'SELECT solicitacao.*, usuario.name
                          FROM solicitacao, usuario
                          WHERE solicitante_id = usuario.id
                          AND usuario.curso_id=:cid',
                'params' => [':cid' => Yii::$app->user->identity->curso_id],
                'pagination' => ['pageSize' => 20],
            ]);

            return $dataProvider;
        }

        /* ********************************************
        * Filtra somente as Solicitacoes feitas
        * por Alunos do Curso que o secretaria logado
        * pertence
        * ****************************************** */
        if(Yii::$app->user->identity->perfil=='Secretaria')
        {

            $dataProvider = new SqlDataProvider([
                'sql' => 'SELECT * FROM solicitacao AS s, usuario AS u WHERE s.solicitante_id=u.id
                            AND u.curso_id=:cid',
                'params' => [':cid' => Yii::$app->user->identity->curso_id],
                'pagination' => ['pageSize' => 20],
            ]);


            return $dataProvider;
        }

        return $dataProvider;
    }
}
