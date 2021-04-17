<?php

use app\models\User;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this View */
/* @var $model User */

$this->title = $model->isNewRecord ? 'Создать' : 'Редактировать';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user">

    <div class="user-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'image')->fileInput() ?>
<br>
        <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>
        <br>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <br>
        <?= $form->field($model, 'about')->widget(CKEditor::class, [
            'options' => ['rows' => 6],
            'preset' => 'full'
        ]) ?>
        <br>
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'myBtn myBtn--accent']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>