<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario_curso".
 *
 * @property integer $id
 * @property integer $usuario
 * @property integer $curso
 */
class UsuarioCurso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario_curso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario', 'curso'], 'required'],
            [['usuario', 'curso'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario' => 'Usuario',
            'curso' => 'Curso',
        ];
    }
}
