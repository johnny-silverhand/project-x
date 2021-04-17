<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\StudyRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Поданные заявления';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="study-request-index">


    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{summary}<br>{items}<br>{pager}",
        'columns' => [
            'id',
            [
                'attribute' => 'fio',
                'value' => function(app\models\StudyRequest $model) {
                    return Html::a($model->fio, ['study-request/view', 'id' => $model->id], ['data-pjax' => 0]);
                },
                'format' => 'raw',
            ],
            'birthdate:date',
            [
                'attribute' => 'specialization_id',
                'value' => function(app\models\StudyRequest $model) {
                    return $model->specialization->code.' - '.$model->specialization->name;
                }
            ],
            'budget:boolean',
            'orphan:boolean',
            'invalid',
            'score',
            'rate',
            'with_docs:boolean',
            [
                'header' => 'Кнопки',
                'controller' => 'study-request',
                'template' => '{update} {invite}',
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['title' => 'Проставить документы']);
                    },
                    'invite' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-check"></span>', $url, ['title' => 'Оформить приказ о приеме',]);
                    },
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
