<?php

namespace app\models;

use Yii;
use app\models\Periodo;
use app\models\Usuario;
use app\models\Atividade;
use marqu3s\behaviors\SaveGridFiltersBehavior;


/**
 * This is the model class for table "solicitacao".
 *
 * @property integer $id
 * @property string $descricao
 * @property string $dtInicio
 * @property string $dtTermino
* @property integer $horasLancadas 
 * @property integer $horasComputadas
 * @property integer $horasMaxAtiv
 * @property string $observacoes
 * @property string $status
 * @property integer $atividade_id
 * @property integer $periodo_id
 * @property integer $solicitante_id
 * @property integer $aprovador_id
 * @property date $created_at
 */
class Solicitacao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	 
	 public $name;
	 
    public static function tableName()
    {
        return 'solicitacao';
    }

    //RELACIONAMENTO com a tabela USUARIO
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'solicitante_id']);
    }

    //RELACIONAMENTO com a tabela ATIVIDADE
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtividade()
    {
        return $this->hasOne(Atividade::className(), ['id' => 'atividade_id']);
    }

    //RELACIONAMENTO com a tabela PERIODO
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriodo()
    {
        return $this->hasOne(Periodo::className(), ['id' => 'periodo_id']);
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao', 'horasLancadas','dtInicio', 'dtTermino', 'status', 'atividade_id', 'solicitante_id'], 'required', 'message'=>'Este campo é obrigatório'],
            //[['dtInicio', 'dtTermino', 'solicitante_id'], 'safe'],
			[['solicitante_id', 'aprovador_id'], 'safe'],
			['dtInicio','validateDates'],
            ['dtTermino','validateDates'],           
			['descricao','validateSolicitacao'],
//			[['dtInicio','dtTermino'], 'date', 'format' => 'php:Y-m-d', 'message'=> 'O formato desta data é inválido'],
//            ['dtTermino', 'compare', 'compareAttribute' => 'dtInicio', 'operator' => '>=', 'message'=> 'A data de término deve ser igual ou maior que a data de início'],
            [['atividade_id'], 'integer', 'message'=>'Este campo deve ser inteiro'],
			[['horasLancadas'], 'integer', 'min'=> 1, 'message'=>'Horas deve ser inteiro', 'tooSmall' => 'Horas computadas deve ser maior que zero'],
            [['descricao', 'observacoes'], 'string', 'max' => 100, 'message'=>'Este campos possui tamanho máximo igual a 100 caracteres', 'tooLong'=>'Este campos possui tamanho máximo igual a 100 caracteres'],
            [['status'], 'string', 'max' => 20],
            [['arquivo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, pdf', 'wrongExtension'=>'Formato incorreto: Aceito somente: png, jpeg e PDF'],
           // [['horasComputadas'], 'horas_check', 'message'=>'As horas computadas não pode ser maior que a hora máxima por atividade'],
            //[['horasComputadas'], 'horas_calc', 'message'=>'Quantidade maxima para atividade foi atingida']
        ];
    }
    
    /*
     * Verifica se a quantidade informada de horas computadas para a Atividade
     * Não ultrapassou o limite daquela atividade
     */
    public function horas_check($attribute, $params) {
        $horasAtual = $this->horasComputadas;
        $atividadeAtual = Atividade::findOne($this->atividade_id);

        if ($horasAtual > $atividadeAtual->max_horas) {
            $this->addError($attribute,'As horas computadas não pode ser maior que a hora máxima por atividade');
        }
    }

    public function horas_calc($attribute, $params){
        $horasComputadas  = (int) $this->horasComputadas;

        $solicitante_id = Yii::$app->user->identity->id ;

        //calcula a quantidade de horas que o Aluno
        //ja tem naquela atividade...
        $cmd = Yii::$app->db->createCommand("SELECT SUM(horasComputadas) AS soma
                    FROM solicitacao AS S
                    WHERE S.atividade_id = $this->atividade_id
                    AND solicitante_id = $solicitante_id
					AND status = 'Deferida'
                ");

        $hsProduzidas = (int) $cmd->queryScalar();
        $Atividade = Atividade::findOne($this->atividade_id);
		$MaxHorasAtividade = (int) $Atividade->max_horas;
		
		$Grupo = Grupo::findOne(['id' => $Atividade->grupo_id]);
        $MaxHorasGrupo = (int) $Grupo->max_horas;

        if($hsProduzidas == $MaxHorasGrupo)
        {
            $this->addError($attribute,"As horas para esse grupo de atividade já chegaram no máximo.");

        }else if(($hsProduzidas + $horasComputadas) > $MaxHorasGrupo){
            $diferenca = (int) ($MaxHorasGrupo - $hsProduzidas);

            $this->addError($attribute,"As horas computadas não podem ultrapassar $diferenca horas que faltam para alcançar o limite desse grupo de atividade.");
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Número',
            'descricao' => 'Descrição da Solicitação',
            'dtInicio' => 'Data de Início',
            'dtTermino' => 'Data de Término',
            'horasComputadas' => 'Horas Lançadas',
			'horasComputadas' => 'Horas Computadas',
            'observacoes' => 'Observações',
            'status' => 'Status',
            'atividade_id' => 'Atividade',
            'solicitante_id' => 'Solicitante',
            'aprovador_id' => 'Aprovador',
            'anexo_id' => 'Anexo',
            'anexoOriginalName' => 'Arquivo Anexo',
            'created_at' => 'Criado Em'
        ];
    }
	
	function checkData($data) {
		return (date('d-m-Y', strtotime($data)) == $data);
    }

	public function validateDates(){
		$erro = false;

        		
	//	 if(!Solicitacao::checkData($this->dtInicio)){
        if(date('d-m-Y', strtotime($this->dtInicio)) <> $this->dtInicio){
		 	$this->dtInicio = "";
		 	$this->addError('dtInicio','a'.$this->dtInicio. 'Por favor, informe uma data de início válida no formato DD-MM-AAAA.');
		 	$erro = true;
		 }
		 else{
		  $this->dtInicio = Yii::$app->formatter->asDate(strtotime($this->dtInicio), 'php:Y-m-d');
		 }
		 if(!Solicitacao::checkData($this->dtTermino)){
			$this->dtTermino = "";
			$this->addError('dtTermino','Por favor, informe uma data de término válida no formato DD-MM-AAAA.');
			$erro = true;
		}	
		else{
			$this->dtTermino = Yii::$app->formatter->asDate(strtotime($this->dtTermino), 'php:Y-m-d');
		}
		
		if($erro == false){
			
			if(strtotime($this->dtInicio) > strtotime(date("Y-m-d"))){
				$this->addError('dtInicio','Por favor, informe uma data de início anterior à data atual');
			}
			if(strtotime($this->dtTermino) > strtotime(date("Y-m-d"))){
				$this->addError('dtTermino','Por favor, informe uma data de término anterior à data atual');
			}
			if(strtotime($this->dtTermino) < strtotime($this->dtInicio)){
				$this->addError('dtInicio','Por favor, informe uma data de início anterior ou igual à data de término');
				$this->addError('dtTermino','Por favor, informe uma data de término posterior ou igual à data de início');
			}
		}
	}	
	
	public function validateSolicitacao(){
				
		$repetida = Solicitacao::findOne(['descricao' => $this->descricao, 'dtInicio' => $this->descricao, 'dtTermino' => $this->dtTermino, 'atividade_id' => $this->atividade_id, 'solicitante_id' => $this->solicitante_id]);
		var_dump($repetida);
		var_dump($this->descricao);
		
		if($repetida){
			$this->addError('descricao','Já existe uma solicitação cadastrada com esses dados.');
		}
	}	
	
	public function behaviors()
	{
		return [
			//'saveGridPage' =>[
//				'class' => SaveGridPaginationBehavior::className(),
	//			'sessionVarName' => self::className() . 'GridPage'
		//	],
			'saveGridFilters' =>[
				'class' => SaveGridFiltersBehavior::className(),
				'sessionVarName' => self::className() . 'GridFilters'
			]
		];
	}
}