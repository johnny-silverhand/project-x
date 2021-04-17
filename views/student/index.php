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
    <br>
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
                'value' => function (Student $model) use ($searchModel, $institutions) {
                    return $searchModel->mode == StudentSearch::CNT_MODE
                        ? ($institutions[$model->institution_id] ?? "")
                        : ($institutions[$model->group->institution_id] ?? "");
                },
            ],
            [
                'attribute' => 'group_id',
                'value' => function(Student $student) use ($searchModel) {
                    return $searchModel->mode == StudentSearch::CNT_MODE ? $student->group_id : $student->group?->code;
                },
            ],
            [
                'attribute' => 'specialization_id',
                'value' => function (Student $model) use ($searchModel, $specializations) {
                    return $searchModel->mode == StudentSearch::CNT_MODE
                        ? $model->specialization_id
                        : $specializations[$model->group?->specialization_id] ?? "";
                }
            ],
            [
                'attribute' => 'status',
                'value' => function (Student $model) use ($searchModel, $statuses) {
                    return $searchModel->mode == StudentSearch::CNT_MODE
                        ? $model->status
                        : $statuses[$model->status] ?? "";
                },
            ],
            [
                'attribute' => 'budget',
                'visible' => $searchModel->mode != StudentSearch::CNT_MODE,
                'format' => 'boolean',
            ],
            [
                'attribute' => 'cntBudget',
                'visible' => $searchModel->mode == StudentSearch::CNT_MODE,
            ],
            'date_start',
            'date_end',
            'birthdate',
            [
                'attribute' => 'orphan',
                'visible' => $searchModel->mode != StudentSearch::CNT_MODE,
                'format' => 'boolean',
            ],
            [
                'attribute' => 'cntOrphan',
                'visible' => $searchModel->mode == StudentSearch::CNT_MODE,
            ],
            [
                'attribute' => 'invalid',
                'value' => function (Student $model) use ($searchModel, $invalidTypes) {
                    return $searchModel->mode == StudentSearch::CNT_MODE
                        ? $model->invalid
                        : $invalidTypes[$model->invalid] ?? "";
                },
            ],
            [
                'attribute' => 'employed',
                'visible' => $searchModel->mode != StudentSearch::CNT_MODE,
                'format' => 'boolean',
            ],
            [
                'attribute' => 'cntEmployed',
                'visible' => $searchModel->mode == StudentSearch::CNT_MODE,
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
