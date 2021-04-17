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
$this->params['breadcrumbs'][] = ['label' => $model->institution->name, 'url' => ['institution/view', 'id' => $model->institution->id]];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>

<div class="student-view">



    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'myBtn myBtn--accent']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'myBtn myBtn--red',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить этого студента?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

        <br>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fio',
            'birthdate:date',            
            [
                'attribute' => 'institution_id',
                'value' => $model->institution->name,
            ],
            [
                'attribute' => 'specialization_id',
                'value' => $model->specialization->code.' - '.$model->specialization->name
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
