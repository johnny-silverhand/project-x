<?php

namespace app\controllers;

use app\models\Institution;
use app\models\Request;
use app\models\RequestDestination;
use app\models\RequestSearch;
use app\repositories\Repository;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class RequestController
 * @package app\controllers
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 */
class RequestController extends Controller
{
    /**
     * RequestController constructor.
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
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'repository' => $this->repository,
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
            'category' => $this->repository->getCategory($model->category),
            'status' => $this->repository->getStatus($model->status),
        ]);
    }

    /**
     * @return string|Response
     */
    public function actionCreate(): string|Response
    {
        $model = new Request(['status' => Repository::WORK]);
        $model->date = date('d.m.Y H:i:s');
        $destination = new RequestDestination();

        if ($destination->load(Yii::$app->request->post()) && $model->load(Yii::$app->request->post()) && $model->save()) {
            foreach ($destination->ids as $institution_id) {
                $requestDestination = new RequestDestination(['request_id' => $model->id, 'institution_id' => $institution_id]);
                $requestDestination->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $institutions = Institution::find()->select('name')->asArray()->indexBy('id')->column();

        return $this->render('_form', [
            'model' => $model,
            'categories' => $this->repository->getCategories(),
            'institutions' => $institutions,
            'destination' => $destination,
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
        $destination = new RequestDestination();
        foreach ($model->requestDestinations as $requestDestination) {
            $destination->ids[$requestDestination->institution_id] = $requestDestination->institution_id;
        }

        if ($destination->load(Yii::$app->request->post()) && $model->load(Yii::$app->request->post()) && $model->save()) {
            foreach ($model->requestDestinations as $requestDestination) {
                $requestDestination->delete();
            }
            foreach ($destination->ids as $institution_id) {
                $requestDestination = new RequestDestination(['request_id' => $model->id, 'institution_id' => $institution_id]);
                $requestDestination->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $institutions = Institution::find()->select('name')->asArray()->indexBy('id')->column();

        return $this->render('_form', [
            'model' => $model,
            'categories' => $this->repository->getCategories(),
            'institutions' => $institutions,
            'destination' => $destination,
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
     * @return Request|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id): Request|null
    {
        if (($model = Request::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
    }
}
