<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\StudyRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Поданные заявления';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="study-request-index">


    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'fio',
            'birthdate',
            'specialization_id',
            'budget:boolean',
            'orphan:boolean',
            'invalid',
            'score',
            'rate',
            'with_docs:boolean',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
