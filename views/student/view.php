<?php

use app\models\Student;
use yii\helpers\Html;
use yii\web\View;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Student */
/* @var $statuses */

$this->title = $model->fio;
$this->params['breadcrumbs'][] = ['label' => 'Учреждения', 'url' => ['institution/index']];
$this->params['breadcrumbs'][] = ['label' => $model->group->institution->name, 'url' => ['institution/view', 'id' => $model->group->institution->id]];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>

<div class="student-view">



    <p>
        <?= Html::a('Приказ о переводе', ['move', 'id' => $model->id], ['class' => 'myBtn myBtn--grey']) ?>
        <?= Html::a('Приказ об отчислении', ['deduction', 'id' => $model->id], ['class' => 'myBtn myBtn--red']) ?>
        <?= Html::a('Загрузка неформализованных данных', ['load', 'institutionId' => $model->id], ['class' => 'myBtn myBtn--accent']) ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'myBtn myBtn--accent']) ?>
    </p>

        <br>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fio',
            'birthdate:date',
            [
                'attribute' => 'institution_id',
                'value' => $model->group->institution->name,
            ],
            [
                'attribute' => 'specialization_id',
                'value' => $model->group->specialization->code.' - '.$model->group->specialization->name
            ],
            [
                'attribute' => 'status',
                'value' => key_exists($model->status, $statuses) ? $statuses[$model->status] : null,
            ],
            'budget:boolean',
            'date_start:date',
            'date_end:date',
        ],
    ]) ?>


</div>
