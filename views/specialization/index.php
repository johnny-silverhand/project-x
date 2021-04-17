<?php

use app\models\Specialization;
use app\models\SpecializationSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

/* @var $this View */
/* @var $searchModel SpecializationSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Специализации';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specialization-index">

    <p>
        <?= Html::a('Добавить специализацию', ['create'], ['class' => 'myBtn']) ?>
    </p>
    <br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{summary}<br>{items}<br>{pager}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'code',
            [
                'attribute' => 'name',
                'value' => function (Specialization $model) {
                    return Html::a($model->name, ['view', 'id' => $model->id]);
                },
                'format' => 'html',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
