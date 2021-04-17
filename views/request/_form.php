<?php

use app\models\Request;
use app\models\RequestDestination;
use dosamigos\ckeditor\CKEditor;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Request */
/* @var $form ActiveForm */
/* @var $categories array */
/* @var $institutions array */
/* @var $destination RequestDestination */

$this->title = $model->isNewRecord ? 'Отправить запрос' : 'Редактировать запрос';
$this->params['breadcrumbs'][] = ['label' => 'Запросы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request">

    <div class="request-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <br>
        <?= $form->field($model, 'category')->dropDownList($categories) ?>
        <br>
        <?= $form->field($destination, 'ids')->widget(Select2::class, ['data' => $institutions, 'options' => ['multiple' => true]]) ?>
        <br>
        <?= $form->field($model, 'content')->widget(CKEditor::class) ?>
        <br>
        <?= $form->field($model, 'data')->widget(Select2::class, ['options' => ['multiple' => true], 'pluginOptions' => ['tags' => true, 'tokenSeparators' => [',', ' ']]]) ?>
        <br>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Отправить' : 'Сохранить', ['class' => 'myBtn myBtn--accent']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
