<?php

use app\models\Institution;
use yii\helpers\Html;
use yii\web\View;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Institution */
/* @var $studentGrid string */
/* @var $requestGrid string */
/* @var $dataGrid string */
/* @var $canEdit bool */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Учреждения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="institution-view">

    <p>
        <?php 
            if($canEdit) {
            echo Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'myBtn myBtn--accent']), ' ',
                 Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'myBtn myBtn--red',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить организацию?',
                'method' => 'post',
            ],
        ]);
        } ?>
    </p>
    <br>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'is_admin:boolean',
        ],
    ]) ?>

    <h3>Контингент:</h3>
<br>
    <?= $studentGrid ?>

    <h3>Приемная комиссия:</h3>
<br>

    <?= $requestGrid ?>
    
</div>
