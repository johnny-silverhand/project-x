<?php

use app\models\StudentSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

/* @var $this View */
/* @var $searchModel StudentSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Студенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-index">

    <p>
        <?= Html::a('Добавить студента', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'fio',
            'birthdate',
            'budget:boolean',
            'date_start',
            //'date_end',
            //'status',
            //'institution_id',
            //'specialization_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
