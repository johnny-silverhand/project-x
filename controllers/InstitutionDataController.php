<?php

namespace app\controllers;

use app\models\Institution;
use app\repositories\Repository;
use Yii;
use app\models\InstitutionData;
use app\models\InstitutionDataSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * Class InstitutionDataController
 * @package app\controllers
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 */
class InstitutionDataController extends Controller
{
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
     * @param $institution_id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionCreate($institution_id): string|Response
    {
        $model = new InstitutionData(['institution_id' => $institution_id]);
        $institution = Institution::findOne($institution_id);

        if ($institution === null) {
            throw new NotFoundHttpException('Организация не найдена!');
        } elseif ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['institution/view', 'id' => $model->institution_id]);
        }

        return $this->render('_form', [
            'model' => $model,
            'categories' => $this->repository->getCategories(),
            'institution' => $institution,
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
            return $this->redirect(['institution/view', 'id' => $model->institution_id]);
        }

        return $this->render('_form', [
            'model' => $model,
            'categories' => $this->repository->getCategories(),
            'institution' => $model->institution,
        ]);
    }

    /**
     * @param $id
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionDelete($id): Response
    {
        $model = $this->findModel($id);
        $institution_id = $model->institution_id;
        $model->delete();

        return $this->redirect(['institution/view', 'id' => $institution_id]);
    }

    /**
     * @param $id
     * @return InstitutionData|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id): InstitutionData|null
    {
        if (($model = InstitutionData::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
    }
}
