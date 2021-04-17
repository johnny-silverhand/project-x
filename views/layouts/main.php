<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<header class="header">
    <div class="wrapper header__wrapper">
        <div class=" header__headerContent">
            <div class="logo header__logo">
                <a href="<?= Url::to(['site/index']) ?>" title="IT animals">
                    <img src="media/logo.jpg" alt="" />
                </a>
            </div>
            <ul class="header__list">
                <li class="header__list-item">
                    <?= Html::a('Главная', ['site/index'], ['class' => 'header__list-link']) ?>
                </li>
                <li class="header__list-item">
                    <?= Html::a('Учреждения', ['institution/index'], ['class' => 'header__list-link']) ?>
                </li>
                <li class="header__list-item">
                    <?= Html::a('Отчет', ['student/index'], ['class' => 'header__list-link']) ?>
                </li>
                <li class="header__list-item">
                    <?= Html::a('Отчет департамента', ['student/index', 'mode' => \app\models\StudentSearch::CNT_MODE], ['class' => 'header__list-link']) ?>
                </li>
                <?php if(!Yii::$app->getUser()->isGuest): ?>
                <li class="header__list-item">
                    <div class="header__avatar">
                        <a href="<?= Url::to(['user/view', 'id' => Yii::$app->getUser()->getId()]) ?>">
                            <img width="45px"
                                 height="45px"
                                 title='Профиль пользователя'
                                 src="media/no_avatar.png"
                                 alt="" class="img-circle"></a>
                    </div>
                    <?= Html::a('Выход', ['site/logout'], ['class' => 'black header__list-link']) ?>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</header>

<main class="content">
    <div class="wrapper">
        <div class="pageTitle content__pageTitle">
            <h1><b><?= $this->title ?></b></h1>
        </div>
        <br>
        <?=
        Breadcrumbs::widget([
            'links' => $this->params['breadcrumbs'] ?? [],
        ])
        ?>
        <div class="content__contentWrapper ">
            <div class="content__minContent">
                    <?= $content ?>
            </div>
            </div>
        </div>
    </div>
</main>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
