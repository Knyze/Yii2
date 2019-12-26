<?php
namespace backend\controllers;

use Yii;
use common\models\Task;
use common\models\Project;
use common\models\User;
use common\models\ProjectUser;
use common\models\search\TaskSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [User::ROLE_ADMIN],
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
     * Lists all Task models.
     * @return mixed
     */
    public function actionIndex()
    {
        $user = Yii::$app->user->identity;
        
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $dataProvider->query->byUser(Yii::$app->user->id);
        
        $users = User::find()->onlyActive();
        $projects = Project::find()->onlyActive();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'users' => $users,
            'projects' => $projects,
            'canCreate' => \Yii::$app->projectService->hasRoleManager($user),
        ]);
    }

    /**
     * Displays a single Task model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $user = Yii::$app->user->identity;
        
        if (\Yii::$app->projectService->hasRole($model->project, $user)) {
        
            $canManage = \Yii::$app->taskService->canManage($model->project, $user);

            return $this->render('view', [
                'model' => $this->findModel($id),
                'canManage' => $canManage,
            ]);
        } else {
            return $this->redirect(['index']);
        }
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $user = Yii::$app->user->identity;
        
        if (\Yii::$app->projectService->hasRoleManager($user)) {
            $model = new Task();
            
            $projects = Project::find()->byUser(Yii::$app->user->id, ProjectUser::ROLE_MANAGER)->onlyActive();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->task_id]);
            }

            return $this->render('create', [
                'model' => $model,
                'projects' => $projects,
            ]);
        } else {
            return $this->redirect(['index']);
        }
        
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $user = Yii::$app->user->identity;
        
        if (\Yii::$app->taskService->canManage($model->project, $user)) {
            
            $projects = Project::find()->onlyActive();
            
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->task_id]);
            }

            return $this->render('update', [
                'model' => $model,
                'projects' => $projects,
            ]);
        } else {
            return $this->redirect(['index']);
        }
        
        //$searchProjects = new ProjectSearch;
        
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $user = Yii::$app->user->identity;
        
        if (\Yii::$app->taskService->canManage($model->project, $user)) {
            $this->findModel($id)->delete();
        }

        return $this->redirect(['index']);
    }
    
    public function actionTake($id)
    {
        $model = $this->findModel($id);
        $user = Yii::$app->user->identity;
        
        if (\Yii::$app->taskService->canTake($model, $user)) {
            \Yii::$app->taskService->takeTask($model, $user);
        }
        
        return $this->actionIndex();
    }
    
    public function actionComplete($id)
    {
        $model = $this->findModel($id);
        $user = Yii::$app->user->identity;
        
        if (\Yii::$app->taskService->canComplete($model, $user)) {
            \Yii::$app->taskService->completeTask($model);
        }
        return $this->actionIndex();
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
