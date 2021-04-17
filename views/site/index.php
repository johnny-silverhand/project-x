<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Главная';
?>
<div class="site-index">
    <?= Html::a('организации', ['institution/index'], ['class' => 'myBtn myBtn--accent']) ?>
    <br>
    <br>
    <?= Html::a('запросы', ['request/index'], ['class' => 'myBtn myBtn--accent']) ?>
    <br>
    <br>
    <?= Html::a('ответы', ['response/index'], ['class' => 'myBtn myBtn--accent']) ?>
    <br>
    <br>
    <?= Html::a('специализации', ['specialization/index'], ['class' => 'myBtn myBtn--accent']) ?>
    <br>
    <br>
    <?= Html::a('студенты', ['student/index'], ['class' => 'myBtn myBtn--accent']) ?>

</div>
