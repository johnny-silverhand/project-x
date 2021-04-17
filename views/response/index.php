<?php

use app\models\ResponseSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

/* @var $this View */
/* @var $searchModel ResponseSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Ответы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="response-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'content:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
