<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
?>

<div class="col-md-4"></div>
<div class="col-xs-12 col-md-4">
    <section class="content-header">
        <h1>Novo Usuário</h1>
    </section>
    <section class="content">
        <div class="box box-success"> 
            <div class="box-body"> 

                <?php $form = ActiveForm::begin(); ?>

                   <div class="col-xs-12">
                         <div class="form-group">
                             <label for="cpf" class="control-label" >CPF</label>
                             
                             <?php echo MaskedInput::widget([
                                'name' => 'cpf',
                                'mask' => ['999.999.999-99']
                            ]); ?>
                             <!--<input type="text" name="cpf" class="form-control" id="cpf" placeholder="Digite seu CPF"/>-->
                         </div>

                        <div class="form-group">
                            <?= Html::submitButton('Enviar', ['class' => 'btn btn-success']) ?>
                             <?= Html::a('Cancelar', ['login/login'], ['class' => 'btn btn-danger']) ?>
                        </div>


                        <?php 

                            if(isset($erro))
                            {
                                echo "<p class='col-sm-12 alert alert-danger'>";
                                echo $erro ;
                                echo "</p>";
                            }
                        ?>
                        </p>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </section>
</div>
<div class="col-md-4"></div>