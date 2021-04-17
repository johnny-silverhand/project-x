<?php

namespace app\controllers;

use app\models\Group;
use Yii;
use app\models\StudyRequest;
use app\models\Student;
use app\models\Institution;
use app\models\Specialization;
use app\repositories\Repository;
use app\models\StudyRequestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StudyRequestController implements the CRUD actions for StudyRequest model.
 */
class StudyRequestController extends Controller
{
    /**
     * InstitutionController constructor.
     * @param $id
     * @param $module
     * @param Repository $repository
     * @param array $config
     */
    public function __construct($id, $module,
                                private Repository $repository,
                                $config = []) {
        parent::__construct($id, $module, $config);
    }
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
     * Lists all StudyRequest models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudyRequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StudyRequest model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StudyRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StudyRequest();
        $model->invited = false;
        $model->with_docs = false;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'institutions' => Institution::getList(),
            'specializations' => Specialization::getList(),
            'invalidTypes' => $this->repository->getInvalidTypes(),
        ]);
    }

    /**
     * Updates an existing StudyRequest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'institutions' => Institution::getList(),
            'specializations' => Specialization::getList(),
            'invalidTypes' => $this->repository->getInvalidTypes(),
        ]);
    }

    public function actionInvite($id) {
        $model = $this->findModel($id);
        $model->invited = true;
        if($model->save()) {
            $student = new Student();
            $student->fio = $model->fio;
            $student->birthdate = $model->birthdate;
            $student->date_start = date('01.09.Y');
            $student->date_end = date('01.07.2023');
            $group = Group::find()->andWhere(['institution_id' => $model->institution_id, 'specialization_id' => $model->specialization_id])->one();
            $student->group_id = $group?->id ?: 1;
            $student->status = Repository::STUDENT_WORK;
            $student->budget = $model->budget;
            $student->save();
            $this->redirect(['institution/view', 'id' => $model->institution_id]);
        }
    }

    /**
     * Deletes an existing StudyRequest model.
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
     * Finds the StudyRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StudyRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StudyRequest::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
