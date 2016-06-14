<?php

namespace app\models;

use Yii;
use app\models\Usuario;

/**
 * This is the model class for table "frequencia".
 *
 * @property integer $id
 * @property integer $IDMonitoria
 * @property string $data
 * @property double $ch
 * @property string $atividade
 */
class Frequencia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frequencia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IDMonitoria', 'dmy', 'ch'], 'required', 'message' => 'Este campo é obrigatório.'],
            [['IDMonitoria'], 'integer'],
            [['dmy'], 'safe'],
            [['ch'], 'integer', 'min' => 1, 'max' => 12, 'tooSmall'=>'O valor não pode ser menor que 1 hora.', 'tooBig'=>'O valor não pode ser maior que 12 horas.', 'message'=>'O valor deve ser inteiro.'],
            [['atividade'], 'string', 'max' => 200, 'tooLong' => 'Descrição da atividade deve conter no máximo 200 caracteres.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'IDMonitoria' => 'Nº Monitoria',
            'dmy' => 'Data do Registro',
            'ch' => 'Carga Horária Executada',
            'atividade' => 'Descrição da Atividade',
        ];
    }

}
