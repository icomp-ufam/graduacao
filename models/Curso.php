<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "curso".
 *
 * @property integer $id
 * @property string $codigo
 * @property string $nome
 * @property integer $max_horas
 */
class Curso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'curso';
    }

    //RELACIONAMENTO com a tabela Usuarios
    public function Usuarios()
    {
        return $this->hasMany(Usuario::className(), ['usuario_id' => 'id']);
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'nome', 'max_horas'], 'required', 'message'=> 'Este campo é obrigatório'],
            [['max_horas'], 'integer', 'min'=> 1, 'max'=> 10000, 'message'=>'Máximo de horas deve ser inteiro', 'tooSmall' => 'Máximo de horas deve ser maior que zero','tooBig' => 'Máximo de horas deve ser menor que 10.000',],
            [['codigo'], 'string', 'max' => 5, 'message'=>'O Código deve ter no máximo 5 caracteres'],
			[['codigo'], 'unique', 'message'=>'Código de curso  já cadastrado'],
            [['nome'], 'string', 'max' => 100, 'message'=>'O nome do curso deve ter no máximo 100 caracteres'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo' => 'Código do Curso',
            'nome' => 'Nome do Curso',
            'max_horas' => 'Máximo de Horas',
        ];
    }
}
