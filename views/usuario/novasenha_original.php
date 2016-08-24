<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerJsFile(Yii::$app->request->baseUrl.'/js/compara.js',['depends' => [\yii\web\JqueryAsset::className()]]);

$this->title = 'Trocar Senha';
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
       <li><a href="?r=usuario/index"><i class="fa fa-user"></i> Usuários</a></li>
        <li class="active"><a href="?r=usuario/view">Trocar Senha</a></li>
    </ol>
</section>
<section class="content">
<div class="box box-success"> 
	 <?php if(Yii::$app->request->get('success')){?>
	   <div id="alerta" class="alert alert-success" role="alert"><?php echo Yii::$app->request->get('success') ?></div>
       <script>
           setTimeout(function(){ $('#alerta').fadeOut(); }, 3000);
       </script>
     <?php } ?>
<div class="box-body">

            <?php $form = ActiveForm::begin(); ?>
                <div class="form-group">
                    <label for="senhanova" class="control-label" >Nova Senha</label>
                    <input type="password" id="pw1" name="senhanova" class="form-control" placeholder="Informe a nova senha" />
                </div>
                <div class="form-group">
                    <label for="senhanova2" class="control-label" >Confirmar senha</label>
                    <input type="password" id="pw2" name="senhanova2" class="form-control" placeholder="Repita sua nova senha" />
                </div>
                    
                <div class="form-group">
                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-success']) ?>
                    <?php
                        if(Yii::$app->user->identity->perfil == "admin")
                            echo Html::a('Cancelar', ['curso/index'], ['class' => 'btn btn-danger']);
						if(Yii::$app->user->identity->perfil == "Secretaria")
                            echo Html::a('Cancelar', ['solicitacao/index'], ['class' => 'btn btn-danger']);
                        else
                            echo Html::a('Cancelar', ['dashboard/index'], ['class' => 'btn btn-danger']);
                    ?>
                </div>

                <div class="col-xs-12">
                    <p class="alert alert-danger" id="status" hidden="true"></p>
                </div>
                <?= Html::input('hidden', 'token', $model->password_reset_token ) ?>
                <?= Html::input('hidden', 'id', $model->id ) ?>
            <?php ActiveForm::end(); ?>
        </div>
</div>
</section>




