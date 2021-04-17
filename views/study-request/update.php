<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StudyRequest */
/* @var $institutions array */
/* @var $specializations array */
/* @var $invalidTypes array*/

$this->title = 'Update Study Request: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Study Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="study-request-update">

    <?= $this->render('_form', [
        'model' => $model,
        'institutions' => $institutions,
        'specializations' => $specializations,
        'invalidTypes' => $invalidTypes,
    ]) ?>

</div>
