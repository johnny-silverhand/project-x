<?php

use app\models\InstitutionData;
use app\models\InstitutionDataSearch;
use app\repositories\Repository;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

/* @var $this View */
/* @var $searchModel InstitutionDataSearch */
/* @var $dataProvider ActiveDataProvider */
/* @var $repository Repository */

?>
<div class="institution-data-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <br>
    <p>
        <?= Html::a('Добавить сведения', ['institution-data/create', 'institution_id' => $searchModel->institution_id], ['class' => 'btn btn-success']) ?>
    </p>
    <br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'category',
                'value' => function (InstitutionData $model) use ($repository) {
                    return $repository->getCategory($model->category);
                },
            ],
            'name',
            'value',

            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'institution-data',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>


</div>
