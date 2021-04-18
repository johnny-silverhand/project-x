<?php

use yii\helpers\Html;
use yii\web\View;
use app\models\User;

/* @var $this View */
/* @var $data array */
/* @var User $user */

$this->title = 'Главная';
?>
<div class="site-index">    
    <?php
        if(!$user->isStudent) {
            echo Html::a('Учреждения', ['institution/index'], ['class' => 'myBtn myBtn--accent']), ' ';
            if(!$user->isWorkerDep) {
                echo Html::a('Отчет по контенгенту', ['student/index'], ['class' => 'myBtn myBtn--accent']), ' ';
            }
            if(!$user->isWorkerSuz) {
                echo Html::a('Отчет департамента', ['student/index', 'mode' => \app\models\StudentSearch::CNT_MODE], ['class' => 'myBtn myBtn--accent']);
            }
            if($user->isAdmin) {
                echo Html::a('Специализации', ['specialization/index'], ['class' => 'myBtn myBtn--accent']), ' ';
            }
        } else {
            echo Html::a('Заявление на поступление', ['study-request/create'], ['class' => 'myBtn myBtn--accent']);
        }
    ?>
<?php 
    if(!$user->isStudent) {
        $this->registerJs("window.dashboardData = " . json_encode($data), View::POS_HEAD);        
        echo Html::tag('div', ' ', ['id' => 'chart']);
    }
?>
