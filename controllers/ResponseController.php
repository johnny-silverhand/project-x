<?php

namespace app\controllers;

use app\models\Institution;
use app\models\Request;
use app\models\Response;
use app\models\ResponseFile;
use app\models\ResponseSearch;
use app\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response as WebResponse;

/**
 * Class ResponseController
 * @package app\controllers
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 */
class ResponseController extends Controller
{
    private ?User $user = null;

    public function __construct($id, $module, $config = [])
    {
        $this->user = Yii::$app->user->getIsGuest() ? null : Yii::$app->user->identity->getUser();
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
        $searchModel = new ResponseSearch();
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @param $request_id
     * @return string|WebResponse
     * @throws NotFoundHttpException
     */
    public function actionCreate($request_id): string|WebResponse
    {
        $request = Request::findOne($request_id);
        $institution = Institution::findOne($this->user->institution_id);
        $model = new Response(['request_id' => $request_id, 'institution_id' => $institution?->id]);
        $model->date = date('d.m.Y H:i:s');
        $responseFile = new ResponseFile();

        /*foreach ($request->requestDestinations as $requestDestination) {
            $requestDestination->institution_id === $institution->id;
        }*/

        if ($institution === null) {
            throw new NotFoundHttpException('Ваша организация не найдена!');
        } elseif ($request === null) {
            throw new NotFoundHttpException('Запрос не найден!');
        } elseif ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('_form', [
            'model' => $model,
            'request' => $request,
            'institution' => $institution,
            'responseFile' => $responseFile,
        ]);
    }

    /**
     * @param $id
     * @return string|WebResponse
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id): string|WebResponse
    {
        $model = $this->findModel($id);
        $institution = Institution::findOne($this->user->institution_id);
        $responseFile = new ResponseFile();

        if ($institution === null) {
            throw new NotFoundHttpException('Ваша организация не найдена!');
        } elseif ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('_form', [
            'model' => $model,
            'request' => $model->request,
            'institution' => $institution,
            'responseFile' => $responseFile,
        ]);
    }

    /**
     * @param $id
     * @return WebResponse
     * @throws NotFoundHttpException
     */
    public function actionDelete($id): WebResponse
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return Response|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id): Response|null
    {
        if (($model = Response::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
    }
}
