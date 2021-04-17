<?php

use app\models\Institution;
use app\models\InstitutionData;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model InstitutionData */
/* @var $form ActiveForm */
/* @var $categories array */
/* @var $institution Institution */

$this->title = $model->isNewRecord ? 'Добавить сведения' : 'Редактировать сведения';
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['institution/index']];
$this->params['breadcrumbs'][] = ['label' => $institution->name, 'url' => ['institution/view', 'id' => $institution->id]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="institution-data-create">

    <div class="institution-data-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'category')->dropDownList($categories) ?>
        <br>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <br>
        <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>
        <br>
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'myBtn myBtn--accent']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
