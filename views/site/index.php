<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Главная';
?>
<div class="site-index">
    <?= Html::a('Учреждения', ['institution/index'], ['class' => 'myBtn myBtn--accent']) ?>
    <br>
    <br>
    <?= Html::a('Заявление на поступление', ['study-request/create'], ['class' => 'myBtn myBtn--accent']) ?>
    <br>
    <br>
    <?= Html::a('Специализации', ['specialization/index'], ['class' => 'myBtn myBtn--accent']) ?>
    <br>
    <br>
    <?= Html::a('Отчет по контенгенту', ['student/index'], ['class' => 'myBtn myBtn--accent']) ?>
    <br>
    <br>
    <?= Html::a('Отчет департамента', ['student/index', 'mode' => \app\models\StudentSearch::CNT_MODE], ['class' => 'myBtn myBtn--accent']) ?>

</div>
