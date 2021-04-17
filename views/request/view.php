<?php

use app\models\Request;
use yii\helpers\Html;
use yii\web\View;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Request */
/* @var $category string */
/* @var $status string */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Запросы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="request-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'myBtn myBtn--accent']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'myBtn myBtn--red',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить запрос?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Сформировать ответ', ['response/create', 'request_id' => $model->id], ['class' => 'myBtn']) ?>
    </p>
    <br>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            [
                'attribute' => 'category',
                'value' => function (Request $model, DetailView $widget) use ($category) {
                    return $category;
                },
            ],
            [
                'attribute' => 'status',
                'value' => function (Request $model, DetailView $widget) use ($status) {
                    return $status;
                },
            ],
            [
                'attribute' => 'data',
                'value' => function (Request $model, DetailView $widget) {
                    return implode(", ", $model->data);
                },
            ],
            [
                'attribute' => 'organisations',
                'value' => function (Request $model, DetailView $widget) {
                    $names = [];
                    foreach ($model->requestDestinations as $requestDestination) {
                        $names[] = Html::tag('b', $requestDestination->institution->name);
                    }
                    return implode(", ", $names);
                },
                'format' => 'html',
            ],
        ],
    ]) ?>

    <h2>Текст запроса: </h2>
    <div>
        <?= $model->content ?>
    </div>

</div>
