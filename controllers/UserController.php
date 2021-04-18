<?php

namespace app\controllers;

use app\models\User;
use app\models\UserSearch;
use app\security\ChangePwdForm;
use app\security\EmailConfirmForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller {

    private ?User $user = null;

    public function __construct(
        $id,
        $module,
        $config = []
    ) {
        $this->user = Yii::$app->user->getIsGuest() ? null : Yii::$app->user->identity->getUser();
        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['view', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'delete', 'create'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => fn() => $this->user && $this->user->isAdmin,
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UserSearch();
        if (!$this->user->isAdmin) {
            $searchModel->id = $this->user->id;
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView(int $id) {
        $model = $this->findModel($id);
        if ($model->id != $this->user->id && !$this->user->isAdmin) {
            throw new ForbiddenHttpException('У Вас нет доступа к данному профилю!');
        }
        return $this->render('view', [
            'model' => $model,
            'canEdit' => $this->user->isAdmin || $id == $this->user->id,
            'canEditRoles' => $this->user->isAdmin
        ]);
    }

    public function actionCreate() {
        $model = new User();
        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model, 'image');
            if ($image) {
                $model->image=file_get_contents($image->tempName);
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('_form', [
            'model' => $model,
        ]);
    }

    public function actionUpdate(int $id) {
        $model = $this->findModel($id);
        $stream = $model->image ? stream_get_contents($model->image) : false;
        if (!$model->isAdmin && $model->id != $this->user->id) {
            throw new ForbiddenHttpException('У Вас нет доступа к данному профилю!');
        }
        if ($model->load(Yii::$app->request->post()) ) {
            $image = UploadedFile::getInstance($model, 'image');
            if ($image) {
                $model->image=file_get_contents($image->tempName);
            } elseif ($stream) {
                $model->image = $stream;
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('_form', [
            'model' => $model,
        ]);
    }

    public function actionDelete(int $id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel(int $id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
    }

}
