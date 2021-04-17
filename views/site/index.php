<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $data array */

$this->title = 'Главная';
?>
<div class="site-index">
    <?= Html::a('Учреждения', ['institution/index'], ['class' => 'myBtn myBtn--accent']) ?>
    <?= Html::a('Заявление на поступление', ['study-request/create'], ['class' => 'myBtn myBtn--accent']) ?>
    <?= Html::a('Специализации', ['specialization/index'], ['class' => 'myBtn myBtn--accent']) ?>
    <?= Html::a('Отчет по контенгенту', ['student/index'], ['class' => 'myBtn myBtn--accent']) ?>
    <?= Html::a('Отчет департамента', ['student/index', 'mode' => \app\models\StudentSearch::CNT_MODE], ['class' => 'myBtn myBtn--accent']) ?>

<?= $this->registerJs("window.dashboardData = " . json_encode($data), View::POS_HEAD); ?>

<div id="chart">
</div>
