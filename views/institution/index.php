<?php

use app\models\Institution;
use app\models\InstitutionSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

/* @var $this View */
/* @var $searchModel InstitutionSearch */
/* @var $dataProvider ActiveDataProvider */
/* @var $canEdit bool*/

$this->title = 'Учреждения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="institution-index">

    <p>
        <?php 
            if($canEdit) {
                echo Html::a('Добавить учреждение', ['create'], ['class' => 'myBtn myBtn--accent']);
            }
        ?>
        
    </p>
    <br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{summary}<br>{items}<br>{pager}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name',
                'value' => function (Institution $model) {
                    return Html::a($model->name, ['view', 'id' => $model->id]);
                },
                'format' => 'html',
            ],
            'is_admin:boolean',

            [
                'class' => 'yii\grid\ActionColumn',
                'visible' => $canEdit
            ],
        ],
    ]); ?>


</div>
