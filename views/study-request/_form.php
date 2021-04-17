<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\StudyRequest */
/* @var $form yii\widgets\ActiveForm */
/* @var $institutions array */
/* @var $specializations array */
?>

<div class="study-request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fio')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'birthdate')->widget(DatePicker::class, [
        'language' => 'ru',
    ]) ?>

    <?= $form->field($model, 'institution_id')->dropDownList($institutions) ?>

    <?= $form->field($model, 'specialization_id')->dropDownList($specializations) ?>

    <?= $form->field($model, 'budget')->checkbox() ?>

    <?= $form->field($model, 'orphan')->checkbox() ?>

    <?= $form->field($model, 'invalid')->dropDownList($invalidTypes) ?>

    <?= $form->field($model, 'score')->textInput() ?>

    <?= $form->field($model, 'rate')->dropDownList([
        1 => 1,
        2 => 2,
        3 => 3,
        4 => 4
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
