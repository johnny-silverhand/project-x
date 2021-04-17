<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\StudyRequest */

$this->title = 'Заявление о поступлении';
$this->params['breadcrumbs'][] = ['label' => 'Учреждения', 'url' => ['institution/index']];
$this->params['breadcrumbs'][] = ['label' => $model->institution->name, 'url' => ['institution/view', 'id' => $model->institution_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="study-request-view">

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fio',
            'birthdate:date',
            [
                'attribute' => 'institution_id',
                'value' => $model->institution->name,
            ],
            [
                'attribute' => 'specialization_id',
                'value' => $model->specialization->code.' - '.$model->specialization->name,
            ],
            'budget:boolean',
            'orphan:boolean',
            'invalid',
            'score',
            'rate',
            'with_docs:boolean',
            'invited:boolean',
        ],
    ]) ?>

</div>
