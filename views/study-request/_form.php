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
    <br>
    <?= $form->field($model, 'birthdate')->widget(DatePicker::class, [
        'language' => 'ru',
    ]) ?>
    <br>
    <?= $form->field($model, 'institution_id')->dropDownList($institutions) ?>
    <br>
    <?= $form->field($model, 'specialization_id')->dropDownList($specializations) ?>
    <br>
    <?= $form->field($model, 'budget')->checkbox() ?>
    <br>
    <?= $form->field($model, 'orphan')->checkbox() ?>
    <br>
    <?= $form->field($model, 'invalid')->dropDownList($invalidTypes) ?>
    <br>
    <?= $form->field($model, 'score')->textInput() ?>
    <br>
    <?= $form->field($model, 'rate')->dropDownList([
        1 => 1,
        2 => 2,
        3 => 3,
        4 => 4
    ]) ?>
<br>
    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'myBtn myBtn--accent']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
