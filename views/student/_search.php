<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StudentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-search">

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

    <?= $form->field($model, 'budget')->checkbox() ?>

    <?= $form->field($model, 'date_start') ?>

    <?php // echo $form->field($model, 'date_end') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'orphan')->checkbox() ?>

    <?php // echo $form->field($model, 'invalid') ?>

    <?php // echo $form->field($model, 'employed')->checkbox() ?>

    <?php // echo $form->field($model, 'institution_id') ?>

    <?php // echo $form->field($model, 'specialization_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'myBtn myBtn--accent']) ?>
        <?= Html::resetButton('Сброс', ['class' => 'myBtn myBtn--red']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
