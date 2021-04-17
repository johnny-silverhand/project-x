<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StudyRequest */
/* @var $institutions array */
/* @var $specializations array */
/* @var $invalidTypes array*/

$this->title = 'Create Study Request';
$this->params['breadcrumbs'][] = ['label' => 'Study Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="study-request-create">

    <?= $this->render('_form', [
        'model' => $model,
        'institutions' => $institutions,
        'specializations' => $specializations,
        'invalidTypes' => $invalidTypes,
    ]) ?>

</div>
