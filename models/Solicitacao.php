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
 *
 * @property Anexo $anexo
 * @property Atividade $atividade
 * @property Periodo $periodo
 * @property Usuario $solicitante
 * @property Usuario $aprovador
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
            [['descricao', 'dtInicio', 'dtTermino', 'status', 'atividade_id', 'periodo_id', 'solicitante_id', 'aprovador_id', 'anexo_id'], 'required'],
            [['dtInicio', 'dtTermino'], 'safe'],
            [['horasComputadas', 'horasMaxAtiv', 'atividade_id', 'periodo_id', 'solicitante_id', 'aprovador_id', 'anexo_id'], 'integer'],
            [['descricao', 'observacoes'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 20],
            [['anexo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Anexo::className(), 'targetAttribute' => ['anexo_id' => 'id']],
            [['atividade_id'], 'exist', 'skipOnError' => true, 'targetClass' => Atividade::className(), 'targetAttribute' => ['atividade_id' => 'id']],
            [['periodo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Periodo::className(), 'targetAttribute' => ['periodo_id' => 'id']],
            [['solicitante_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['solicitante_id' => 'id']],
            [['aprovador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['aprovador_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Descricao',
            'dtInicio' => 'Data Inicio',
            'dtTermino' => 'Dt Termino',
            'horasComputadas' => 'Horas Computadas',
            'horasMaxAtiv' => 'Horas Max Ativ',
            'observacoes' => 'Observacoes',
            'status' => 'Status',
            'atividade_id' => 'Atividade ID',
            'periodo_id' => 'Periodo ID',
            'solicitante_id' => 'Solicitante ID',
            'aprovador_id' => 'Aprovador ID',
            'anexo_id' => 'Anexo ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnexo()
    {
        return $this->hasOne(Anexo::className(), ['id' => 'anexo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtividade()
    {
        return $this->hasOne(Atividade::className(), ['id' => 'atividade_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriodo()
    {
        return $this->hasOne(Periodo::className(), ['id' => 'periodo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitante()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'solicitante_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAprovador()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'aprovador_id']);
    }
}
