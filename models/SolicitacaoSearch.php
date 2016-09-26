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
            [['id', 'horasLancadas', 'horasComputadas', 'atividade_id', 'solicitante_id', 'aprovador_id', 'anexo_id'], 'integer'],
            [['descricao', 'dtInicio', 'dtTermino', 'observacoes', 'status', 'solicitante_id', 'name'], 'safe'],
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
        $query = Solicitacao::find()->select("atividade.*, solicitacao.*")->joinWith("atividade");

        /* ********************************************
        * Filtra somente as Solicitacoes feitas
        * por Alunos do Curso que o Coordenador 
        * ou Secrataria logado pertence
        * ****************************************** */
        if(Yii::$app->user->identity->perfil=='Coordenador' || Yii::$app->user->identity->perfil=='Secretaria')
        {
            $query = Solicitacao::find()->select("atividade.*, solicitacao.*, usuario.name")->joinWith(["usuario"])->joinWith("atividade")
           ->where('status <> "Aberto" AND usuario.isAtivo = 1 AND usuario.curso_id = '.Yii::$app->user->identity->curso_id);
		   
        }
		
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //$this->load($params);
		$dataProvider = $this->loadWithFilters($params, $dataProvider); // From SaveGridFiltersBehavior

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

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
		
		//$dataProvider->sort->attributes['atividade'] = [
          //  'asc' => ['atividade' => SORT_ASC],
//            'desc' => ['atividade' => SORT_DESC],
  //      ];

		// grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'dtInicio' => $this->dtInicio,
            'dtTermino' => $this->dtTermino,
            'horasLancadas' => $this->horasLancadas,
			'horasComputadas' => $this->horasComputadas,
            'atividade_id' => $this->atividade_id,
            'solicitante_id' => $this->solicitante_id,
            'aprovador_id' => $this->aprovador_id,
			'status' => $this->status,
            'anexo_id' => $this->anexo_id,
        ]);

        $query->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'usuario.name', $this->name])
		//	->andFilterWhere(['like', 'atividade.nome', $this->atividade])			
			->andFilterWhere(['like', 'observacoes', $this->observacoes]);
        		

        return $dataProvider;
    }
	
}
