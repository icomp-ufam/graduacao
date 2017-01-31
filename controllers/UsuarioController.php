<?php
namespace app\controllers;
use app\models\UsuarioCurso;
use Yii;
use app\models\Usuario;
use app\models\Curso;
use app\models\UsuarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
/**
 * UsuarioController implements the CRUD actions for Usuario model.
 */
class UsuarioController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','index', 'update', 'view', 'delete'],
                'rules' => [
                    [
                        'actions' => ['create','index', 'update', 'view', 'delete'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            if(!Yii::$app->user->isGuest)
                            {
                                return Yii::$app->user->identity->isAdmin == 1 ;
                            }
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    /**
     * Lists all Usuario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Lists all Usuario models.
     * @return mixed
     */
    public function actionAlunos()
    {
        $searchModel = new UsuarioSearch();

	$model = $this->findModel(Yii::$app->user->id);

        $dataProvider = $searchModel->searchAlunos(Yii::$app->request->queryParams, $model->curso_id);

        return $this->render('alunos', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuario model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

	$model = $this->findModel($id);
		
	$curso = Curso::findOne($model->curso_id);
        if ($curso != null)
            $model->curso_id = $curso->codigo."-".$curso->nome;
		
		return $this->render('view', [
            'model' => $model,
        ]);
		
    }
    /**
     * Creates a new Usuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Usuario();
        $model->scenario = 'insert';

        $usuarioCursos = UsuarioCurso::findAll(['usuario' => 0]);
        foreach ($usuarioCursos as $uc){
            $model->curso_id[]=$uc;
        }


        if ($model->load(Yii::$app->request->post()) ){//&& $model->save()) {

            //verifica se o CPF já está cadastrado
            $usuario = Usuario::find()->where(['cpf' => $model->cpf ])->one();

            if( $usuario != null ){
                $model->addError('cpf','O CPF informado já está cadastrado...');
                return $this->render('create', ['model' => $model]);
            }

            //verifica se o EMAIL já está cadastrado
            $usuario = Usuario::find()->where(['email' => $model->email ])->one();

            if( $usuario != null ){
                $model->addError('email','O EMAIL informado já está cadastrado...');
                return $this->render('create', ['model' => $model]);
            }

            $model->isAtivo = 1;
			// criptografa a senha...
            $model->password = md5($model->password);
	         $model->password_repeat = md5($model->password_repeat);

            if($model->perfil == 'admin') $model->isAdmin = 1;
            else $model->isAdmin = 0;

            $model->telefone= '';
            $model->endereco= '';
            $model->rg='';

            $array = $model->curso_id;

            if($model->perfil == 'Aluno'){
                if(count($array) > 1){
                    $model->addError('curso_id','Selecione apenas um curso.');
                    return $this->render('create', ['model' => $model]);
                }
                if (empty($array)) {
                    $model->addError('curso_id','Este campo é obrigatório para Alunos');
                    return $this->render('create', ['model' => $model]);;
                }
            }


            if (!empty($array)) {
                $model->curso_id = $array[0];
            }

           // $model->curso_id = NULL;

            if($model->save()) {

                $usuarioSalvo = Usuario::find()->where(['cpf' => $model->cpf ])->one();

                if(!empty($array)) {

                    foreach ($array as $curso) {

                        $modelUsuarioCurso = new UsuarioCurso();

                        $modelUsuarioCurso->usuario = $usuarioSalvo->id;
                        $modelUsuarioCurso->curso = $curso;

                        $modelUsuarioCurso->load(Yii::$app->request->post());
                        $modelUsuarioCurso->save();

                    }

                }

                return $this->redirect(['view', 'id' => $model->id]);

            }else
                return $this->render('create', ['model' => $model,]);
			
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Updates an existing Usuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $senhaAntiga = $model->password;
        $model->isAtivo = 1;

        $usuarioCursos = UsuarioCurso::findAll(['usuario' => $id]);

        if ($model->load(Yii::$app->request->post())){
						
			if($model->password != ""){
				$model->password = md5($model->password);
				$model->password_repeat = md5($model->password_repeat);
			}
			else{
				$model->password = $senhaAntiga;
				$model->password_repeat = $senhaAntiga;
			}

            if($model->perfil == 'admin') $model->isAdmin = 1;
            else $model->isAdmin = 0;

            $model->telefone= '';
            $model->endereco= '';
            $model->rg='';

            $array = $model->curso_id;

            if($model->perfil == 'Aluno'){
                if(count($array) > 1){
                    $model->addError('curso_id','Selecione apenas um curso.');
                    return $this->render('create', ['model' => $model]);
                }
                if (empty($array)) {
                    $model->addError('curso_id','Este campo é obrigatório para Alunos');
                    return $this->render('create', ['model' => $model]);;
                }
            }


            if (!empty($array)) {
                $model->curso_id = $array[0];
            }

           // $model->curso_id = NULL;

            if($model->save()) {
                $usuarioSalvo = Usuario::find()->where(['cpf' => $model->cpf ])->one();
                //deletar usuarioCursos associado ao usuário
                if(!empty($usuarioCursos)) {
                    foreach ($usuarioCursos as $uc) {
                        $uc->delete();
                    }
                }

                //Salvar
                if(!empty($array)) {

                    foreach ($array as $curso) {

                        $modelUsuarioCurso = new UsuarioCurso();

                        $modelUsuarioCurso->usuario = $usuarioSalvo->id;
                        $modelUsuarioCurso->curso = $curso;

                        $modelUsuarioCurso->load(Yii::$app->request->post());
                        $modelUsuarioCurso->save();

                    }

                }

                return $this->redirect(['view', 'id' => $model->id]);
            }else
				return $this->render('update', ['model' => $model,]);
			
        } else {
            $usuarioCursos = UsuarioCurso::findAll(['usuario' => $id]);

            if(!empty($usuarioCursos)){

                foreach ($usuarioCursos as $uc){
                    $cursos[]=$uc->curso;
                }

                $model->curso_id=$cursos;
            }

            return $this->render('update', [
                'model' => $model,  'usuarioCursos' =>$usuarioCursos
            ]);
        }
    }




    /**
     * Deletes an existing Usuario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }
    /**
     * Finds the Usuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('A página procurada não existe.');
        }
    }

    public function actionTrocasenha()
    {

        $id = Yii::$app->user->identity->id;
		$model = $this->findModel($id);
		$senhaAntiga = $model->password;
		$model->isAtivo = 1;

        if ($model->load(Yii::$app->request->post())){
			if($model->password != "")
				$model->password = md5($model->password);
			else
				$model->password = $senhaAntiga;
			
			$model->save(false);
			return $this->redirect(['usuario/trocasenha','success' => 'Dados alterados com sucesso!']);
			
        } else {
			
			return $this->render('novasenha', ['model' => $model,]);
        }

		
	/*if ( Yii::$app->request->post())
        {

            $model = new Usuario();

            //busca o usuario pelo ID
            $id = Yii::$app->user->identity->id;

            $model = Usuario::find()->where(['id'=>$id])->one();

            $model->password = md5(Yii::$app->request->post('senhanova'));

            $model->save(false);
            
            return $this->redirect(['usuario/trocasenha','success' => 'Senha alterada com sucesso!']);
        }
        else
        {
            $model = new Usuario();

            //busca o usuario pelo ID
            $id = Yii::$app->user->identity->id;

            $model = Usuario::find()->where(['id'=>$id])->one();

            if($model==null)
            {
                throw new NotFoundHttpException('A página procurada não existe.');
            }

            return $this->render('novasenha', ['model' => $model]);
        }*/
    }

    protected function mensagens($tipo, $titulo, $mensagem){
        Yii::$app->session->setFlash($tipo, [
            'type' => $tipo,
            'icon' => 'home',
            'duration' => 5000,
            'message' => $mensagem,
            'title' => $titulo,
            'positonY' => 'top',
            'positonX' => 'center',
            'showProgressbar' => true,
        ]);
    }

    public function actionAlterar(){

        $usuario = Usuario::find()->where(['id'=>Yii::$app->user->identity->id])->one();
        $idCurso= Yii::$app->request->post('curso');
        $idCurso = str_replace('\'','', $idCurso);
        $usuario->curso_id =(string)$idCurso;

        if($usuario->save(false)){
            if(Yii::$app->user->identity->perfil == "Secretaria")
                return $this->redirect('index.php');

            elseif (Yii::$app->user->identity->perfil == "Coordenador")
                return $this->redirect(['dashboard/index']);

            elseif (Yii::$app->user->identity->perfil == "admin")
                return $this->redirect(['curso/index']);
        }
    }


}
