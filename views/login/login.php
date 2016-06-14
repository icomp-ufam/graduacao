<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/validaCPF.js',['depends' => [\yii\web\JqueryAsset::className()]]);
?>


   <div class="login-box">
      <div class="login-logo">
         <a href="#"><b>Atividades Acadêmicas</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
      <p class="login-box-msg">Insira seu CPF e a senha para entrar</p>
        <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'fieldConfig' => ['labelOptions' => ['class' => 'control-label'],
        ],
        ]); ?>
         
        <?= $form->field($model, 'cpf',['template' => "{label}\n{input}\n{hint}\n{error}"])->textInput(array('placeholder' => 'CPF: XXX.XXX.XXX-XX','class'=>'form-control'))->label(false)?>

        <?= $form->field($model, 'password')->passwordInput(array('placeholder' => 'Senha'))->label(false)?>
        
        <div class="row">
            <div class="col-xs-4 pull-right">
                 <button type="submit" name="login-button" class="btn btn-success btn-block btn-flat">Entrar</button>
            </div><!-- /.col -->
        </div>
        
        <?php ActiveForm::end(); ?>
        

        <a href="?r=login/recuperarsenha">Solicitar Nova Senha</a><br>
        <a href="?r=login/novousuario" class="text-center">Registrar aluno</a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

  