<?php

use app\models\Student;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this View */
/* @var $model Student */
/* @var $form ActiveForm */
/* @var $groups array */
/* @var $specializations array */

$this->title = $model->isNewRecord ? 'Добавить студента' : 'Редактировать студента';
$this->params['breadcrumbs'][] = ['label' => 'Студенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student">

    <div class="student-form">

        <?php $form = ActiveForm::begin([
            'action' => ['student/create', 'institutionId' => $model->institution_id],
            'options' => ['enctype' => 'multipart/form-data'],
        ]);
        ?>

        <?= $form->field($model, 'content')->widget(CKEditor::class) ?>
        <br>

        <?= Html::fileInput('file') ?>
        <br>

        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'myBtn myBtn--accent']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
