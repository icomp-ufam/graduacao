<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grupo".
 *
 * @property integer $id
 * @property string $codigo
 * @property string $nome
 * @property integer $max_horas
 */
class Grupo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grupo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'nome', 'max_horas'], 'required', 'message'=>'Este campo é obrigatório'],
			[['max_horas'], 'integer', 'min'=> 1, 'max'=> 10000, 'message'=>'Máximo de horas deve ser inteiro', 'tooSmall' => 'Máximo de horas deve ser maior que zero','tooBig' => 'Máximo de horas deve ser menor que 10.000',],
            [['codigo'], 'string', 'max' => 20, 'tooLong'=>'Código deve ser tamanho máximo de 20 caracteres'],
            [['nome'], 'string', 'max' => 100, 'tooLong'=>'Nome do grupo deve ser tamanho máximo de 100 caracteres'],
		//	[['codigo'], 'unique', 'message'=>'Código de grupo já cadastrado'],
		//	[['nome'], 'unique', 'message'=>'Nome de grupo já cadastrado'],
            //['curso_id', 'safe'],
		//	['max_horas','validateHora'],
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
            'nome' => 'Nome',
            'max_horas' => 'Máximo de Horas',
        ];
    }

/*	public function validateHora(){

		$curso = Curso::findOne($this->curso_id);

		if($this->max_horas > $curso->max_horas){
			$this->addError('max_horas','As horas são superiores às horas máximas previstas para o curso');
		}
	}*/
}
