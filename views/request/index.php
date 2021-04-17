<?php

use app\models\Request;
use app\models\RequestSearch;
use app\repositories\Repository;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

/* @var $this View */
/* @var $searchModel RequestSearch */
/* @var $dataProvider ActiveDataProvider */
/* @var $repository Repository */

$this->title = 'Запросы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="institution-index">

    <p>
        <?= Html::a('Отправить запрос', ['create'], ['class' => 'myBtn myBtn--accent']) ?>
    </p>
    <br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'attribute' => 'category',
                'filter' => $repository->getCategories(),
                'value' => function (Request $model) use ($repository) {
                    return $repository->getCategory($model->category);
                },
            ],
            [
                'attribute' => 'status',
                'filter' => $repository->getStatuses(),
                'value' => function (Request $model) use ($repository) {
                    return $repository->getStatus($model->status);
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
