<?php

use app\models\ResponseFile;
use yii\helpers\Html;
use yii\web\View;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model ResponseFile */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Файлы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="response-file-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'response_id',
            'type',
            'content:ntext',
        ],
    ]) ?>

</div>
