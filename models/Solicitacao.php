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
 * @property integer $anexo_id
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['horasComputadas','dtInicio', 'dtTermino', 'status', 'atividade_id', 'periodo_id', 'solicitante_id', 'aprovador_id', 'anexo_id'], 'required', 'message'=>'Este
campo é obrigatório'],
            [['dtInicio', 'dtTermino'], 'safe'],
            [['horasComputadas', 'horasMaxAtiv', 'atividade_id', 'periodo_id', 'solicitante_id', 'aprovador_id', 'anexo_id'], 'integer'],
            [['descricao', 'observacoes'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 20],
            ['horasMaxAtiv', 'integer', 'min'=>1, 'max'=>120],
            ['horasComputadas', 'integer', 'min'=>1, 'max'=>120],
            [['arquivo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, pdf'],
        ];
    }

    //faz o upload do arquivo com o nome mudado...
    public function upload()
    {
        
        

        $nomeDoArquivo = Yii::$app->user->identity->id . '_' . rand(1,999999). '_' . $arquivo->extension ;
        
        $this->arquivo->saveAs('uploads/' . $nomeDoArquivo . '.' . $this->arquivo->extension);
        
        return true;

    }
    
    
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            //'id' => 'ID',
            'descricao' => 'Descrição',
            'dtInicio' => 'Data de Início',
            'dtTermino' => 'Data de Término',
            'horasComputadas' => 'Horas Computadas',
            //'horasMaxAtiv' => 'Máximo de Horas de Atividade',
            //'observacoes' => 'Observações',
            'status' => 'Status',
            //'atividade_id' => 'Atividade',
            //'periodo_id' => 'Período',
            //'solicitante_id' => 'Solicitante',
            //'aprovador_id' => 'Aprovador',
            //'anexo_id' => 'Anexo',
            'anexoOriginalName' => 'Arquivo Anexo',
        ];
    }
}