<?php

use app\models\StudentSearch;
use app\models\Student;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

/* @var $this View */
/* @var $searchModel StudentSearch */
/* @var $dataProvider ActiveDataProvider */
/* @var $specializations array */
/* @var $statuses array */
/* @var $groups array */
/* @var $canEdit bool */

//$this->title = 'Студенты';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-index">

    <?php
        if($canEdit) { ?>
            <p>
                <?= Html::a('Приказ о зачислении', ['student/create', 'institutionId' => $searchModel->institution_id], ['class' => 'myBtn myBtn--accent']) ?>
                <?= Html::a('Загрузка неформализованных данных', ['student/raw', 'institutionId' => $searchModel->institution_id], ['class' => 'myBtn myBtn--accent']) ?>
            </p>
            <br>
    <?php } ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{summary}<br>{items}<br>{pager}",
        'columns' => [
            [
                'attribute' => 'fio',
                'value' => function(Student $student) {
                    return Html::a($student->fio, ['student/view', 'id' => $student->id], ['data-pjax' => 0]);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'specialization_id',
                'value' => function(Student $student) {
                    return $student->group->specialization->code.' - '.$student->group->specialization->name;
                },
                'filter' => $specializations,
            ],
            [
                'attribute' => 'group_id',
                'value' => function(Student $student) {
                    return $student->group->code;
                },
                'filter' => $groups,
            ],
            [
                'attribute' => 'status',
                'value' => function(Student $student) use ($statuses) {
                    return key_exists($student->status, $statuses) ? $statuses[$student->status] : null;
                },
                'filter' => $statuses,
            ],
            'budget:boolean',
            'birthdate',
            'date_start',
            'date_end',
        ],
    ]); ?>


</div>
