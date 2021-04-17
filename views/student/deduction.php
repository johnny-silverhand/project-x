<?php

use app\models\Student;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this View */
/* @var $model Student */
/* @var $form ActiveForm */
/* @var $statuses array */

$this->title = 'Приказ об отчислении';
$this->params['breadcrumbs'][] = ['label' => 'Студенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fio, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="student-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->dropDownList($statuses) ?>

    <?= $form->field($model, 'employed')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'myBtn myBtn--accent']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>