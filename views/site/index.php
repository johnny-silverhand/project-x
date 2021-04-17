<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $data array */

$this->title = 'Главная';

$this->registerJs("window.dashboardData = " . json_encode($data), View::POS_HEAD);
?>

<div id="chart">
</div>