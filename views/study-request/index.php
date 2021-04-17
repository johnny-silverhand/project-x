<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\StudyRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Поданные заявления';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="study-request-index">


    <p>
        <?= Html::a('Подать заявление', ['create'], ['class' => 'myBtn myBtn--accent']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{summary}<br>{items}<br>{pager}",
        'columns' => [
            'id',
            'fio',
            'birthdate',
            'institution_id',
            'specialization_id',
            'budget:boolean',
            'orphan:boolean',
            'invalid',
            'score',
            'rate',
            'with_docs:boolean',
            'invited:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
