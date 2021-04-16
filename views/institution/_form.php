<?php

use app\models\Institution;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Institution */
/* @var $form ActiveForm */

$this->title = $model->isNewRecord ? 'Добавить организацию' : 'Редактировать организацию';
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="institution">

    <div class="institution-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'is_admin')->checkbox() ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'myBtn']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
