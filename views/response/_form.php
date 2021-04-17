<?php

use app\models\Institution;
use app\models\Request;
use app\models\Response;
use app\models\ResponseFile;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Response */
/* @var $form ActiveForm */
/* @var $request Request */
/* @var $institution Institution */
/* @var $responseFile ResponseFile */

$this->title = $model->isNewRecord ? 'Сформировать ответ' : 'Редактировать ответ';
$this->params['breadcrumbs'][] = ['label' => 'Запросы', 'url' => ['request/index']];
$this->params['breadcrumbs'][] = ['label' => $request->name, 'url' => ['request/view', 'id' => $request->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="response">
    <p>Ответ на запрос: &laquo;<?= $request->name ?>&raquo;</p>
    <p>От организации: &laquo;<?= $institution->name ?>&raquo;</p>
    <p>Текст запроса:</p>
    <p><?= $request->content ?></p>
    <p>Запрашиваемые сведения:</p>
    <p><?= implode(", ", $request->data) ?></p>

    <div class="response-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'content')->widget(CKEditor::class) ?>

        <?= $form->field($responseFile, 'id')->fileInput() ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Отправить' : 'Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
