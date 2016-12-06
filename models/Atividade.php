<?php

namespace app\models;

use Yii;
use marqu3s\behaviors\SaveGridFiltersBehavior;

/**
 * This is the model class for table "atividade".
 *
 * @property integer $id
 * @property string $codigo
 * @property string $nome
 * @property integer $max_horas
 * @property integer $curso_id
 * @property integer $grupo_id
 */
class Atividade extends \yii\db\ActiveRecord
{
 
	public $curso;
	public $grupo;
	
	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'atividade';
    }

    public function getSolicitacoes()
    {
        return $this->hasMany(Solicitacao::className(), ['atividade_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'nome', 'max_horas', 'curso_id', 'grupo_id'], 'required', 'message'=> 'Este campo é obrigatório'],
            [['curso_id', 'grupo_id'], 'integer', 'message'=>'Este campo deve ser numérico'],
			[['max_horas'], 'integer', 'min'=> 1, 'max'=> 10000, 'message'=>'Máximo de horas deve ser inteiro', 'tooSmall' => 'Máximo de horas deve ser maior que zero','tooBig' => 'Máximo de horas deve ser menor que 10.000',],
            [['codigo'], 'string', 'max' => 5, 'tooLong'=>'Código deve ser tamanho máximo de 5 caracteres'],
            [['nome'], 'string', 'max' => 100, 'tooLong'=>'Nome da atividade deve ser tamanho máximo de 100 caracteres'],
			['nome','validateAtividade'],
			['codigo','validateCodigo'],
			['max_horas','validateHora'],
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
            'curso_id' => 'Curso',
            'grupo_id' => 'Grupo',

        ];
    }
	
	public function validateAtividade(){
		
		$atividadeIgual = Atividade::findOne(['codigo' => $this->codigo, 'nome' => $this->nome, 'curso_id' => $this->curso_id]);
		
		if($atividadeIgual && $atividadeIgual->id != $this->id){
			$this->addError('nome','Já existe atividade com este código e nome associada ao curso corrente');
		}
	}	
	
	public function validateCodigo(){
		
		$codigoIgual = Atividade::findOne(['codigo' => $this->codigo, 'curso_id' => $this->curso_id]);
		
		if($codigoIgual && $codigoIgual->id != $this->id){
			$this->addError('codigo','Já existe código com este valor associado ao curso corrente');
		}
	}	
	
	public function validateHora(){
		
		$curso = Curso::findOne($this->curso_id);
		
		if($this->max_horas > $curso->max_horas){
			$this->addError('max_horas','As horas são superiores às horas máximas previstas para o curso');
		}
	}
	
	public function behaviors()
	{
		return [
			'saveGridFilters' =>[
				'class' => SaveGridFiltersBehavior::className(),
				'sessionVarName' => self::className() . 'GridFilters'
			]
		];
	}	
}
