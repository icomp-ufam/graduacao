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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'nome', 'max_horas'], 'required'],
            [['max_horas'], 'integer'],
            [['codigo'], 'string', 'max' => 5],
            [['nome'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo' => 'Codigo do Curso',
            'nome' => 'Nome do Curso',
            'max_horas' => 'Máximo de Horas',
        ];
    }
}
