<?php

use app\models\Student;
use app\models\StudentSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this View */
/* @var $searchModel StudentSearch */
/* @var $dataProvider ActiveDataProvider */
/* @var $statuses array */
/* @var $specializations array */
/* @var $institutions array */
/* @var $invalidTypes array */

$this->title = 'Студенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-index">

    <p>
        <?= Html::a('Добавить студента', ['create'], ['class' => 'myBtn myBtn--accent']) ?>
    </p>
    <br>

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel, 'invalidTypes' => $invalidTypes]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fio',
            'birthdate',
            'budget:boolean',
            'date_start',
            'date_end',
            [
                'attribute' => 'status',
                'value' => function (Student $model) use ($statuses) {
                    return $statuses[$model->status] ?? "";
                },
            ],
            /*'orphan:boolean',*/
            [
                'attribute' => 'invalid',
                'value' => function (Student $model) use ($invalidTypes) {
                    return $invalidTypes[$model->invalid] ?? "";
                },
            ],
            'employed:boolean',
            [
                'attribute' => 'institution_id',
                'value' => function (Student $model) use ($institutions) {
                    return $institutions[$model->institution_id] ?? "";
                },
            ],
            [
                'attribute' => 'specialization_id',
                'value' => function (Student $model) use ($specializations) {
                    return $specializations[$model->specialization_id] ?? "";
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
