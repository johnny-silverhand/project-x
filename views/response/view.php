<?php

use app\models\Response;
use yii\helpers\Html;
use yii\web\View;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Response */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ответы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="response-view">

    <p>Ответ на запрос: &laquo;<?= $model->request->name ?>&raquo;</p>
    <p>От организации: &laquo;<?= $model->institution->name ?>&raquo;</p>
    <p>Текст запроса:</p>
    <p><?= $model->request->content ?></p>
    <p>Текст ответа:</p>
    <p><?= $model->content ?></p>

</div>
