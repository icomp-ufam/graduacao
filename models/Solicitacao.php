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

    //RELACIONAMENTO com a tabela usuario
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'solicitante_id']);
    }
    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao','horasComputadas','dtInicio', 'dtTermino', 'status', 'atividade_id'], 'required', 'message'=>'Este campo é obrigatório'],
            [['dtInicio', 'dtTermino'], 'safe'],
            ['dtTermino', 'compare', 'compareAttribute' => 'dtInicio', 'operator' => '>=', 'message'=> 'A data de término deve ser igual ou maior que a data de início'],
            [['horasComputadas', 'atividade_id'], 'integer'],
            [['descricao', 'observacoes'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 20],
            ['horasComputadas', 'integer', 'min'=>1, 'max'=>100], //Isto depende da atividade cadastrada.
            [['arquivo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, pdf'],
            [['horasComputadas'], 'horas_check', 'message'=>'As horas computadas não pode ser maior que a hora máxima por atividade']
        ];
    }
    
    
     public function horas_check($attribute, $params) {
         
      $horasAtual = $this->horasComputadas;
      $atividadeAtual = Atividade::findOne($this->atividade_id);
         
      if ($horasAtual > $atividadeAtual->max_horas) {
          $this->addError($attribute,'As horas computadas não pode ser maior que a hora máxima por atividade');
      }

     }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Número',
            'descricao' => 'Descrição',
            'dtInicio' => 'Data de Início',
            'dtTermino' => 'Data de Término',
            'horasComputadas' => 'Horas Computadas',
            'observacoes' => 'Observações',
            'status' => 'Status',
            'atividade_id' => 'Atividade',
            'solicitante_id' => 'Solicitante',
            'aprovador_id' => 'Aprovador',
            'anexo_id' => 'Anexo',
            'anexoOriginalName' => 'Arquivo Anexo'
        ];
    }
}