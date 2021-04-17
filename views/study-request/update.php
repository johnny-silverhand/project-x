<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StudyRequest */
/* @var $institutions array */
/* @var $specializations array */
/* @var $invalidTypes array*/

$this->title = 'Изменение заявления';
$this->params['breadcrumbs'][] = ['label' => 'Учреждения', 'url' => ['institution/index']];
$this->params['breadcrumbs'][] = ['label' => $model->institution->name, 'url' => ['institution/view', 'id' => $model->institution_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="study-request-update">

        <div class="study-request-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'specialization_id')->dropDownList($specializations) ?>

        <?= $form->field($model, 'with_docs')->checkbox() ?>


        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
