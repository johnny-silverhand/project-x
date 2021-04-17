<?php

use app\models\Institution;
use yii\helpers\Html;
use yii\web\View;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Institution */
/* @var $studentGrid string */
/* @var $dataGrid string */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Учреждения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="institution-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'myBtn myBtn--accent']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'myBtn myBtn--red',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить организацию?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <br>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'is_admin:boolean',
        ],
    ]) ?>

    <h1>Учащиеся:</h1>

    <?= $studentGrid ?>

    <!--<h2>Другие сведения</h2>

    <?= $dataGrid ?>
    --!>
</div>
