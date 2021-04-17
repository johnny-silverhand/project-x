<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\StudentSearch */
/* @var $form yii\widgets\ActiveForm */
/* @var $statuses array */
/* @var $specializations array */
/* @var $institutions array */
?>

<div class="student-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'fio') ?>

    <?= $form->field($model, 'birthdate')->widget(DatePicker::class, [
        'language' => 'ru',
    ]) ?>

    <?= $form->field($model, 'budget')->checkbox() ?>

    <?= $form->field($model, 'date_start')->widget(DatePicker::class, [
        'language' => 'ru',
    ]) ?>

    <?= $form->field($model, 'date_end')->widget(DatePicker::class, [
        'language' => 'ru',
    ]) ?>

    <?= $form->field($model, 'status')->dropDownList($statuses) ?>

    <?= $form->field($model, 'orphan')->checkbox() ?>

    <?= $form->field($model, 'invalid') ?>

    <?= $form->field($model, 'employed')->checkbox() ?>

    <?= $form->field($model, 'institution_id')->dropDownList($institutions) ?>

    <?= $form->field($model, 'specialization_id')->dropDownList($specializations) ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'myBtn myBtn--accent']) ?>
        <?= Html::resetButton('Сброс', ['class' => 'myBtn myBtn--red']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
