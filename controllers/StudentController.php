<?php

namespace app\controllers;

use app\models\Institution;
use Yii;
use app\models\Student;
use app\models\Specialization;
use app\repositories\Repository;
use app\models\StudentSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * Class StudentController
 * @package app\controllers
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 */
class StudentController extends Controller
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
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'specializations'  => Specialization::getList(),
            'statuses' => $this->repository->getStudentStatuses(),
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'specializations' => Specialization::getList(),
            'statuses' => $this->repository->getStudentStatuses(),
        ]);
    }

    /**
     * @return string|Response
     */
    public function actionCreate(int $institutionId): Response|string
    {
        $model = new Student();
        $model->institution_id = $institutionId;
        $model->status = Repository::STUDENT_WORK;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['institution/view', 'id' => $model->institution_id]);
        }

        return $this->render('_form', [
            'model' => $model,
            'specializations'  => Specialization::getList()
        ]);
    }

    /**
     * @param $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id): Response|string
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('_form', [
            'model' => $model,
            'specializations'  => Specialization::getList()
        ]);
    }

    public function actionMove($id): string|Response
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('move', [
            'model' => $model,
            'specializations'  => Specialization::getList(),
            'institutions' => Institution::getList(),
        ]);
    }

    public function actionDeduction($id): string|Response
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $statuses = $this->repository->getStudentStatuses();
        unset($statuses[Repository::STUDENT_WORK]);
        return $this->render('deduction', [
            'model' => $model,
            'statuses' => $statuses,
        ]);
    }

    /**
     * @param $id
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionDelete($id): Response
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return Student|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id): ?Student
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
    }
}
