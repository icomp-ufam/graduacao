<?php

namespace app\models;

use Yii;
use app\models\Usuario;
use app\models\Atividade;


/**
 * This is the model class for table "solicitacao".
 *
 * @property integer $id
 * @property string $descricao
 * @property string $dtInicio
 * @property string $dtTermino
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
            [['descricao','horasComputadas','dtInicio', 'dtTermino', 'status', 'atividade_id'], 'required', 'message'=>'Este campo é obrigatório'],
            [['dtInicio', 'dtTermino', 'solicitante_id'], 'safe'],
            ['dtTermino', 'compare', 'compareAttribute' => 'dtInicio', 'operator' => '>=', 'message'=> 'A data de término deve ser igual ou maior que a data de início'],
            [['horasComputadas', 'atividade_id'], 'integer'],
            [['descricao', 'observacoes'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 20],
            ['horasComputadas', 'integer', 'min'=>1, 'max'=>100], //Isto depende da atividade cadastrada.
            [['arquivo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, pdf', 'wrongExtension'=>'Formato incorreto: Aceito somente: png, jpeg e PDF'],
            [['horasComputadas'], 'horas_check', 'message'=>'As horas computadas não pode ser maior que a hora máxima por atividade'],
            [['horasComputadas'], 'horas_calc', 'message'=>'Quantidade maxima para atividade foi atingida']
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
                ");

        $hsProduzidas = (int) $cmd->queryScalar();

        $Atividade = Atividade::findOne($this->atividade_id);

        $MaxHorasAtividade = (int) $Atividade->max_horas;

        if($hsProduzidas == $MaxHorasAtividade)
        {
            $this->addError($attribute,"As horas para esse tipo de atividade já chegaram no máximo.");

        }else if(($hsProduzidas + $horasComputadas) > $MaxHorasAtividade){
            $diferenca = (int) ($MaxHorasAtividade - $hsProduzidas);

            $this->addError($attribute,"As horas computadas não podem ultrapassar $diferenca horas que faltam para alcançar o limite desse tipo de atividade.");
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
            'horasComputadas' => 'Horas',
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
}