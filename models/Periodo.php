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
            [['dtInicio', 'dtTermino'], 'safe'],
            [['codigo'], 'string', 'max' => 10],
            
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
            'isAtivo'  => 'Status do Período'
        ];
    }
    

}
