<?php

namespace app\controllers;

use app\models\InstitutionDataSearch;
use app\models\StudentSearch;
use app\models\Specialization;
use app\repositories\Repository;
use Yii;
use app\models\Institution;
use app\models\InstitutionSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * Class InstitutionController
 * @package app\controllers
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 */
class InstitutionController extends Controller
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
    public function actionIndex(): string
    {
        $searchModel = new InstitutionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id): string
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
            'studentGrid' => $this->renderStudents($model),
            'dataGrid' => $this->renderData($model)
        ]);
    }
    private function renderStudents(Institution $model): string
    {
        $searchModel = new StudentSearch(['institution_id' => $model->id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->renderPartial('/student/institution_index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'specializations' => Specialization::getList(),
            'statuses' => $this->repository->getStudentStatuses(),
        ]);
    }


    private function renderData(Institution $model): string
    {
        $searchModel = new InstitutionDataSearch(['institution_id' => $model->id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->renderPartial('/institution-data/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'repository' => $this->repository,
        ]);
    }

    /**
     * @return string|Response
     */
    public function actionCreate(): string|Response
    {
        $model = new Institution();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('_form', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id): string|Response
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('_form', [
            'model' => $model,
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
     * @return Institution|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id): Institution|null
    {
        if (($model = Institution::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
    }
}
