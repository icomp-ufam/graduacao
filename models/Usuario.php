<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\base\Security;
use yii\web\IdentityInterface;
use yiibr\brvalidator\CpfValidator;
use yiibr\brvalidator\YiiConditionalValidator;
use app\models\Curso;
use app\models\Solicitacao;
use marqu3s\behaviors\SaveGridFiltersBehavior;

/**
 * This is the model class for table "usuario".
 *
 * @property integer $id
 * @property string $name
 * @property string $cpf
 * @property string $email
 * @property string $password
 * @property string $matricula
 * @property string $siape
 * @property string $perfil
 * @property string $dtEntrada
 * @property integer $isAdmin
 * @property integer $isAtivo
 * @property string $auth_key
 * @property string $remember_token
 * @property string $curso_id
 */
class Usuario extends \yii\db\ActiveRecord  implements IdentityInterface
{
    /**
     * @inheritdoc
     */
	 
	 public $password_repeat;
	 
    public static function tableName()
    {
        return 'usuario';
    }

    //RELACIONAMENTO com a tabela Solicitações
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getSolicitacao()
    {
        return $this->hasMany(Solicitacao::className(), ['solicitante_id'=>'id']);
    }
    
    //RELACIONAMENTO com a tabela Curso
    public function getCurso()
    {
        return $this->hasOne(Curso::className(), ['id' => 'curso_id']);
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['name', 'cpf', 'email', 'perfil'], 'required', 'message'=> 'Este campo é obrigatório'],
			['curso_id', 'required', 'when' => function($model) { return $model->perfil == 'Aluno';}, 'whenClient' => "function (attribute, value) {
				return $('#curso_id').val() == 'Aluno';}", 'message'=> 'Este campo é obrigatório para Alunos'],
			['matricula', 'required', 'when' => function($model) { return $model->perfil == 'Aluno';}, 'whenClient' => "function (attribute, value) {
				return $('#matricula').val() == 'Aluno';}", 'message'=> 'Este campo é obrigatório para Alunos'],
			[['dtEntrada', 'name', 'password', 'password_repeat'], 'safe'],
            [['isAdmin', 'isAtivo', 'curso_id', 'matricula'], 'integer', 'message'=> 'Este campo deve ser numérico'],
			[['password'], 'required', 'on' => 'insert', 'message'=> 'Este campo é obrigatório'],
            [['name', 'cpf', 'siape', 'perfil', 'password_reset_token'], 'string', 'max' => 100, 'message'=>'Este campos possui tamanho máximo igual a 100 caracteres', 'tooLong'=>'Este campos possui tamanho máximo igual a 100 caracteres'],
			['email', 'email', 'message'=> 'E-mail inválido'],
			['email', 'unique', 'message'=> 'E-mail já cadastrado no sistema'],
            [['auth_key'], 'string', 'max' => 255],
            // cpf validator
            ['cpf', CpfValidator::className(), 'message'=> 'CPF inválido'],
			['password_repeat', 'compare', 'compareAttribute'=>'password', 'skipOnEmpty' => false, 'message'=>"Esta senha não é igual à anterior"],
        ];
    }
	
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome',
            'cpf' => 'CPF',
            'email' => 'Email',
            'password' => 'Senha',
			'password_repeat' => 'Confirmar Senha',
            'matricula' => 'Matrícula',
            'siape' => 'SIAPE',
            'perfil' => 'Perfil',
            'dtEntrada' => 'Data de Entrada',

            //'isAdmin' => 'Admin',
            //'isAtivo' => 'Ativo',
            //'auth_key' => 'Auth Key',
            //'password_reset_token' => 'Remember Token',
            'curso_id' => 'Curso',
        ];
    }
    
    
    /**
    * @inheritdoc
    */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
          return static::findOne(['access_token' => $token]);
    }
 
    /**
     * Finds user by CPF
     *
     * @param  string      $cpf
     * @return static|null
     */
    public static function findByCpf($cpf)
    {
        return static::findOne(['cpf' => $cpf]);
    }
    
    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Security::generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Security::generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        // gera uma string aleatoria...
        
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		
		$key = substr(str_shuffle(str_repeat($chars, 5)), 0, strlen($chars) );
        
        $key = substr($key, 0, 20);
        
        $token = $key ;
        
        $this->password_reset_token = $token ;
        
        $this->save();
        
        return $token;
        
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    
    /*
    * gera uma senha.()
    * ************************************** */

    public function senhaAleatoria()
    {
        // gera uma string aleatoria... nao muito segura... kkk
        
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		$key = substr(str_shuffle(str_repeat($chars, 5)), 0, strlen($chars) );
        $key = substr($key, 0, 12);
        $password = $key ;
        $this->password = md5($password);    

        $this->save();

        return $password ; //sem ta criptografado =) eh logico...      
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
