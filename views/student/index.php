<?php

use app\models\Student;
use app\models\StudentSearch;
use yii\data\ActiveDataProvider;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\web\View;
use yii\widgets\Pjax;
use yii\helpers\Html;

/* @var $this View */
/* @var $searchModel StudentSearch */
/* @var $dataProvider ActiveDataProvider */
/* @var $statuses array */
/* @var $specializations array */
/* @var $institutions array */
/* @var $invalidTypes array */

$this->title = 'Контингент';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-index">

    <br>

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', [
        'model' => $searchModel,
        'specializations'  => $specializations,
        'statuses' => $statuses,
        'institutions' => $institutions,
        'invalidTypes' => $invalidTypes,
    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => null,
        'layout' => "{summary}<br><br>{toolbar}<br><br>{items}<br><br>{pager}",
        'toolbar'=>[
            '{export}',
            '{toggleData}'
        ],
        'columns' => [
            [
                'attribute' => 'fio',
                'value' => function(Student $student) {
                    return Html::a($student->fio, ['student/view', 'id' => $student->id], ['data-pjax' => 0]);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'institution_id',
                'value' => function (Student $model) use ($institutions) {
                    return $institutions[$model->group->institution_id] ?? "";
                },
            ],
            [
                'attribute' => 'group_id',
                'value' => function(Student $student) {
                    return $student->group->code;
                },
            ],
            [
                'attribute' => 'specialization_id',
                'value' => function (Student $model) use ($specializations) {
                    return $specializations[$model->group->specialization_id] ?? "";
                }
            ],
            [
                'attribute' => 'status',
                'value' => function (Student $model) use ($statuses) {
                    return $statuses[$model->status] ?? "";
                },
            ],
            'budget:boolean',
            'date_start',
            'date_end',
            'birthdate',
            'orphan:boolean',
            [
                'attribute' => 'invalid',
                'value' => function (Student $model) use ($invalidTypes) {
                    return $invalidTypes[$model->invalid] ?? "";
                },
            ],
            'employed:boolean',
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
