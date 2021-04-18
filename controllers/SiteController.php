<?php

namespace app\controllers;

use app\models\ContactForm;
use app\models\Institution;
use app\models\Role;
use app\models\User;
use app\security\LoginForm;
use app\security\RegistrationForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    /**
     * @var User|null
     */
    private ?User $user = null;

    /**
     * SiteController constructor.
     * @param $id
     * @param $module
     * @param array $config
     */
    public function __construct($id, $module,
                                $config = []) {
        $this->user = Yii::$app->user->getIsGuest() ? null : Yii::$app->user->identity->getUser();
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
                'only' => ['logout', 'index'],
                'rules' => [
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Главная страница.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = Institution::find()->orderBy('id');
        if($this->user->isWorkerSuz) {
            $query->andWhere(['id' => $this->user->institution_id]);
        }
        $institutions = $query->all();
        $data = [];
        /* @var $institutions Institution[] */
        foreach ($institutions as $institution) {
            $data[] = [
                'id' => $institution->id,
                'name' => $institution->name,
                'children' => [
                    /*['name' => 'бюджет', 'id' => 1, 'value' => $institution->getCountBudget()],
                    ['name' => 'внебюджет', 'id' => 1, 'value' => $institution->getCountNotBudget()],
                    ['name' => 'сироты', 'id' => 1, 'value' => $institution->getCountOrphan()],
                    ['name' => 'инвалиды', 'id' => 1, 'value' => $institution->getCountInvalid()],*/
                    ['name' => 'Зачисленных', 'id' => 1, 'value' => $institution->getCountStudyRequestInvited()],
                    ['name' => 'Не зачисленных', 'id' => 1, 'value' => $institution->getCountStudyRequestNotInvited()],
                ],
            ];
        }
        return $this->render('index', [
            'data' => $data,
            'user' => Yii::$app->user->getIdentity()->getUser(),
        ]);
    }

    /**
     * Авторизация
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Регистрация
     */
    public function actionRegistration() {
        $model = Yii::$container->get(RegistrationForm::class);
        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            return $this->redirect(['login']);
        }
        $institutions = Institution::getList();
        return $this->render('registration', [
            'model' => $model,
            'institutions' => [null => 'Нет'] + $institutions,
            'roles' => Role::getGlobalList(),
        ]);
    }

    /**
     * Выход
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
