<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "anexo".
 *
 * @property integer $id
 * @property string $nome
 * @property string $tipo
 * @property integer $hash
 *
 * @property Solicitacao[] $solicitacaos
 */
class Anexo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'anexo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'tipo', 'hash'], 'required'],
            [['hash'], 'integer'],
            [['nome'], 'string', 'max' => 5],
            [['tipo'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'tipo' => 'Tipo',
            'hash' => 'Hash',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitacaos()
    {
        return $this->hasMany(Solicitacao::className(), ['anexo_id' => 'id']);
    }
}
