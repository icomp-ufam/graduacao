<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "periodo".
 *
 * @property integer $id
 * @property string $codigo
 * @property string $dtInicio
 * @property string $dtTermino
 */
class Periodo extends \yii\db\ActiveRecord
{
    public $traducao_isAtivo;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'periodo';
    }

    public function getSolicitacoes()
    {
        return $this->hasMany(Solicitacao::className(), ['periodo_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'dtInicio', 'dtTermino'], 'required', 'message'=> 'Este campo é obrigatório'],
            [['dtInicio', 'dtTermino', 'dtInicioInscMonitoria', 'dtTerminoInscMonitoria'], 'safe'],
            [['justificativaPlanoSemestral'], 'string'],
            [['isAtivo'], 'integer'],
            [['codigo'], 'string', 'max' => 10],
            [['codigo'], 'unique', 'message'=>'Código de período já cadastrado'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo' => 'Código',
            'dtInicio' => 'Data de Início',
            'dtTermino' => 'Data de Término',
            'isAtivo'  => 'Período Corrente',
            'dtInicioInscMonitoria' => 'Início da Inscrição para Monitoria',
            'dtTerminoInscMonitoria' => 'Término da Inscrição para Monitoria',
            'justificativaPlanoSemestral' => 'Justificativas do Plano Semestral'
        ];
    }
    
    public function afterFind()
    {
        switch ($this->isAtivo)
        {
            case 0:
                $this->traducao_isAtivo = 'Não';
                break;
            case 1:
                $this->traducao_isAtivo = 'Sim';
                break;
        }
    }
}
