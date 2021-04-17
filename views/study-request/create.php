<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StudyRequest */
/* @var $institutions array */
/* @var $specializations array */
/* @var $invalidTypes array*/

$this->title = 'Подать заявление';
$this->params['breadcrumbs'][] = ['label' => 'Заявления', 'url' => ['index']];
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
