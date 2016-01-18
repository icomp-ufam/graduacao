<?php

namespace app\models;

use Yii;
use app\models\Usuario;
use yii\base\Object;

/**
 * This is the model class for "Relatorio Geral".
 *
 * @property integer $id
 * @property string $codigo
 * @property string $nome
 * @property integer $max_horas
 */
class RelatorioGeral extends \yii\db\ActiveRecord
{


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'aluno' => 'Aluno',
            'matricula' => 'Matrícula',

        ];
    }
}
