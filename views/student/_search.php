<?php

use app\models\StudentSearch;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $statuses array */
/* @var $specializations array */
/* @var $institutions array */
/* @var $this View */
/* @var $model StudentSearch */
/* @var $form ActiveForm */
/* @var $invalidTypes array */

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

    <?php echo $form->field($model, 'invalid')->dropDownList($invalidTypes) ?>

    <?= $form->field($model, 'employed')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'myBtn myBtn--accent']) ?>
        <?= Html::resetButton('Сброс', ['class' => 'myBtn myBtn--red']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
