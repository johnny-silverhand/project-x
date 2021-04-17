<?php

use app\models\UserSearch;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;

/* @var $this View */
/* @var $model UserSearch */
/* @var $form ActiveForm */

?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        //'layout' => 'horizontal',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="col-md-3">
        <?= $form->field($model, 'surname') ?>
    </div>

    <div class="col-md-3">
        <?= $form->field($model, 'email') ?>
    </div>

    <div class="col-md-3">
        <p class="content__button-wrapper pull-left" style="margin-top: 23px;">
            <?= Html::submitButton('Поиск', ['class' => 'myButton myButton--blue']) ?>
        </p>
    </div>


    <?php ActiveForm::end(); ?>

</div>
