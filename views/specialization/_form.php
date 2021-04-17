<?php

use app\models\Specialization;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Specialization */
/* @var $form ActiveForm */

$this->title = $model->isNewRecord ? 'Добавить специализацию' : 'Редактировать специализацию';
$this->params['breadcrumbs'][] = ['label' => 'Специализации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specialization">

    <div class="specialization-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
        <br>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <br>
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'myBtn']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
