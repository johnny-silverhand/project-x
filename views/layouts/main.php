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
                    <?= Html::a('Запросы', ['request/index'], ['class' => 'header__list-link']) ?>
                </li>
                <li class="header__list-item">
                    <?= Html::a('Организации', ['institution/index'], ['class' => 'header__list-link']) ?>
                </li>
                <?php if(!Yii::$app->getUser()->isGuest): ?>
                <li class="header__list-item">
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
        <div class="content__minContent mt10 ">
            <div class="content__tableWrapper">
                <div class="content__btnSizeTable"></div>
                    <?= $content ?>
            </div>
        </div>
    </div>
</main>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
