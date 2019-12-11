<?php

namespace backend\controllers;

use Yii;
use common\models\Project;
use common\models\search\ProjectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\ProjectUser;
use yii\data\ActiveDataProvider;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        $query = ProjectUser::find()->where(['project_id' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
            
        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Project();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->project_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        //if ($model->load(Yii::$app->request->post()) && $model->save()) {
        if ($this->loadModel($model) && $model->save()) {
        //if ($this->loadModel($model) && Yii::$app->projectService->update($model)) {
            return $this->redirect(['view', 'id' => $model->project_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'users' => \common\models\User::find()->select('username')->indexBy('id')->column(),
        ]);
    }

    /**
     * Deletes an existing Project model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    private function loadModel($model)
    {
        $data = Yii::$app->request->post($model->formName());
        $projectUsers = $data[Project::RELATION_PROJECT_USERS];
        if ($projectUsers !== null) {
            $model->projectUsers = [];
            $model->projectUsers = $projectUsers;
            //$model->projectUsers = $projectUsers === '' ? [] : $projectUsers;
            //die(var_dump($model->projectUsers));
            //Так и не получилось
            //У меня php 5.6, может из-за этого?
            //Если нет ни одной записи то нормально вставляется
            //А если есть, то записывается 1 последняя, даже если просто редактирую
        }
        return $model->load(Yii::$app->request->post());
    }
}
