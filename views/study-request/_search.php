<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StudyRequestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="study-request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fio') ?>

    <?= $form->field($model, 'birthdate') ?>

    <?= $form->field($model, 'institution_id') ?>

    <?= $form->field($model, 'specialization_id') ?>

    <?php // echo $form->field($model, 'budget')->checkbox() ?>

    <?php // echo $form->field($model, 'orphan')->checkbox() ?>

    <?php // echo $form->field($model, 'invalid') ?>

    <?php // echo $form->field($model, 'score') ?>

    <?php // echo $form->field($model, 'rate') ?>

    <?php // echo $form->field($model, 'with_docs')->checkbox() ?>

    <?php // echo $form->field($model, 'invited')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
