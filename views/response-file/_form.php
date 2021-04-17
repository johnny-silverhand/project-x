<?php

use app\models\ResponseFile;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model ResponseFile */
/* @var $form ActiveForm */

$this->title = 'Добавить файл';
$this->params['breadcrumbs'][] = ['label' => 'Файлы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="response-file-create">

    <div class="response-file-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'response_id')->textInput() ?>
        <br>
        <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>
        <br>
        <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
        <br>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>