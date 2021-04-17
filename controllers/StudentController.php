<?php

namespace app\controllers;

use app\models\Institution;
use Yii;
use yii\web\UploadedFile;
use app\models\Student;
use app\models\Specialization;
use app\models\Group;
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
    public function actionIndex($mode = StudentSearch::DEFAULT_MODE)
    {
        $searchModel = new StudentSearch(['mode' => $mode]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'specializations'  => Specialization::getList(),
            'statuses' => $this->repository->getStudentStatuses(),
            'institutions' => Institution::getList(),
            'invalidTypes' => $this->repository->getInvalidTypes(),
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
    private function getFileContent($file): string {
        $officeMimes = [
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/msword',
            'application/vnd.oasis.opendocument.text',
        ];
        $content = '';
            if(in_array($file->type, ['image/jpeg', 'image/png'])) {
                exec("tesseract -l rus+eng {$file->tempName} stdout > /tmp/tesseract.txt");
                $content = file_get_contents('/tmp/tesseract.txt');
            } elseif(in_array($file->type, $officeMimes)) {
                $file->saveAs('/tmp/office.html');
                exec("soffice --headless --convert-to html:HTML '/tmp/office.html'");
                $content = file_get_contents('/tmp/office.html');
            } elseif($file->type == 'application/pdf') {
                exec("pdftohtml -dataurls -fmt png -noframes -stdout {$file->tempName} > /tmp/pdf.html");
                $content = file_get_contents('/tmp/pdf.html');
            } elseif($file->type == 'text/plain') {
                $content = file_get_contents($file->tempName);
            }
        return $content;
    }

    /**
     * @return string|Response
     */
    public function actionCreate(int $institutionId): Response|string
    {
        $model = new Student();
        $model->status = Repository::STUDENT_WORK;
        $file = UploadedFile::getInstanceByName('file');
        if($file) {
            $content = $this->getFileContent($file);
            $extractor = new \app\services\Extractor($content);
            $result = $extractor->searchData();
            $model->attributes = $result->attributes;
        } elseif($model->load(Yii::$app->request->post()) && $model->content && !$model->fio) {
            $extractor = new \app\services\Extractor($model->content);
            $result = $extractor->searchData();
            $model->attributes = $result->attributes;
        } elseif ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['institution/view', 'id' => $model->group->institution_id]);
        }

        return $this->render('_form', [
            'model' => $model,
            'groups' => Group::getList($institutionId, true),
        ]);
    }

    /**
     * @return string|Response
     */
    public function actionRaw(int $institutionId): Response|string
    {
        $model = new Student();
        $model->institution_id = $institutionId;

        return $this->render('raw', [
            'model' => $model,
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
