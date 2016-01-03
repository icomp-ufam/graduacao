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
         <a href="#"><b>ICOMP</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
          <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => ['labelOptions' => ['class' => 'control-label'],
        ],
        ]); ?>
         
         <?= $form->field($model, 'cpf')->textInput()?>

         <?= $form->field($model, 'password')->passwordInput()?>
           <div class="form-group">
                        <button type="submit" name="login-button" class="btn btn-success">Entrar</button>
                    </div>
          <?php ActiveForm::end(); ?>
        

        <a href="#">Recuperar a senha</a><br>
        <a href="register.html" class="text-center">Registrar aluno</a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

  