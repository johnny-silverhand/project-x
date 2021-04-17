<?php

use app\models\Student;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Student */
/* @var $form ActiveForm */
$this->title = $model->isNewRecord ? 'Добавить студента' : 'Редактировать студента';
$this->params['breadcrumbs'][] = ['label' => 'Студенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student">

    <div class="student-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'birthdate')->textInput() ?>

        <?= $form->field($model, 'budget')->checkbox() ?>

        <?= $form->field($model, 'date_start')->textInput() ?>

        <?= $form->field($model, 'date_end')->textInput() ?>

        <?= $form->field($model, 'status')->textInput() ?>

        <?= $form->field($model, 'institution_id')->textInput() ?>

        <?= $form->field($model, 'specialization_id')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'myBtn myBtn--accent']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
