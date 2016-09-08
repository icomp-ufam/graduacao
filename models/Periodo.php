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
            [['codigo', 'dtInicio', 'dtTermino', 'dtInicioInscMonitoria','dtTerminoInscMonitoria'], 'required', 'message'=> 'Este campo é obrigatório'],
			//[['dtInicio','dtTermino','dtInicioInscMonitoria','dtTerminoInscMonitoria'], 'date', 'format' => 'php:Y-m-d', 'message'=> 'O formato desta data é inválido'],
			[['dtInicio','dtTermino','dtInicioInscMonitoria','dtTerminoInscMonitoria'], 'default', 'value' => null],
			['dtInicio','validateDates'],
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
	
	function checkData($data) {
		return (date('d-m-Y', strtotime($data)) == $data);
    }

	public function validateDates(){
		$erro = false;
		
		if(!Periodo::checkData($this->dtInicio)){
			$this->dtInicio = "";
			$this->addError('dtInicio','Por favor, informe uma data de início válida no formato DD-MM-AAAA.');
			$erro = true;
		}
		else{
			$this->dtInicio = Yii::$app->formatter->asDate(strtotime($this->dtInicio), 'php:Y-m-d');
		}
		if(!Periodo::checkData($this->dtTermino)){
			$this->dtTermino = "";
			$this->addError('dtTermino','Por favor, informe uma data de término válida no formato DD-MM-AAAA.');
			$erro = true;
		}	
		else{
			$this->dtTermino = Yii::$app->formatter->asDate(strtotime($this->dtTermino), 'php:Y-m-d');
		}
		
		if($erro == false){
			if(strtotime($this->dtTermino) <= strtotime($this->dtInicio)){
				$this->addError('dtInicio','Por favor, informe uma data de início anterior à data de término');
				$this->addError('dtTermino','Por favor, informe uma data de término posterior à data de início');
			}
		}

		$erroMonitoria = false;
		if(!Periodo::checkData($this->dtInicioInscMonitoria)){
			$this->dtInicioInscMonitoria = "";
			$this->addError('dtInicioInscMonitoria','Por favor, informe uma data de início de monitoria válida no formato DD-MM-AAAA.');
			$erroMonitoria = true;
		}
		else{
			$this->dtInicioInscMonitoria = Yii::$app->formatter->asDate(strtotime($this->dtInicioInscMonitoria), 'php:Y-m-d');
		}
		
		if(!Periodo::checkData($this->dtTerminoInscMonitoria)){
			$this->dtTerminoInscMonitoria = "";
			$this->addError('dtTerminoInscMonitoria','Por favor, informe uma data de término de monitoria válida no formato DD-MM-AAAA.');
			$erroMonitoria = true;
		}
		else{
			$this->dtTerminoInscMonitoria = Yii::$app->formatter->asDate(strtotime($this->dtTerminoInscMonitoria), 'php:Y-m-d');
		}
		
		if(!$erroMonitoria){
			if(strtotime($this->dtTerminoInscMonitoria) <= strtotime($this->dtInicioInscMonitoria)){
				$this->addError('dtInicioInscMonitoria','Por favor, informe uma data de início da inscrição de monitoria anterior à data de término');
				$this->addError('dtTerminoInscMonitoria','Por favor, informe uma data de término da inscrição de monitoria posterior à data de início');
			}
			
			if(!$erro){
				if(strtotime($this->dtInicioInscMonitoria) < strtotime($this->dtInicio) || strtotime($this->dtInicioInscMonitoria) > strtotime($this->dtTermino)){
					$this->addError('dtInicioInscMonitoria','A data de início da inscrição de monitoria deve ser dentro do intervalo do período');
				}
				if(strtotime($this->dtTerminoInscMonitoria) < strtotime($this->dtInicio) || strtotime($this->dtTerminoInscMonitoria) > strtotime($this->dtTermino)){
					$this->addError('dtTerminoInscMonitoria','A data de término da inscrição de monitoria deve ser dentro do intervalo do período');
				}
			}
		}
	}
	
}
