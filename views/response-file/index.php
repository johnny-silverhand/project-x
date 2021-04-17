<?php

use app\models\ResponseFileSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

/* @var $this View */
/* @var $searchModel ResponseFileSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Файлы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="response-file-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'response_id',
            'type',
            'content:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
