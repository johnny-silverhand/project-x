<?php

use app\models\Student;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this View */
/* @var $model Student */
/* @var $form ActiveForm */
/* @var $specializations array */

$this->title = $model->isNewRecord ? 'Добавить студента' : 'Редактировать студента';
$this->params['breadcrumbs'][] = ['label' => 'Студенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student">

    <div class="student-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'fio')->textInput(['maxlength' => 50]) ?>

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

        <?= $form->field($model, 'specialization_id')->dropDownList($specializations) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'myBtn myBtn--accent']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
