<?php

namespace app\models;

use Yii;

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
    public function Solicitante()
    {
        return $this->hasOne(app\models\Usuario::className(), ['id' => 'solicitante_id']);
    }
    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['horasComputadas','dtInicio', 'dtTermino', 'status', 'atividade_id', 'anexo_id'], 'required', 'message'=>'Este campo é obrigatório'],
            [['dtInicio', 'dtTermino'], 'safe'],
            [['horasComputadas', 'atividade_id', 'anexo_id'], 'integer'],
            [['descricao', 'observacoes'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 20],
            ['horasComputadas', 'integer', 'min'=>1, 'max'=>120],
            [['arquivo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, pdf'],
        ];
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
            'anexoOriginalName' => 'Arquivo Anexo',
        ];
    }
}