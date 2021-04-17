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
/* @var $institutions array */

$this->title = 'Приказ о переводе';
$this->params['breadcrumbs'][] = ['label' => 'Студенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fio, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="student-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'institution_id')->dropDownList($institutions) ?>

        <?= $form->field($model, 'specialization_id')->dropDownList($specializations) ?>

        <div class="form-group">
            <?= Html::submitButton('Перевод', ['class' => 'myBtn myBtn--accent']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>