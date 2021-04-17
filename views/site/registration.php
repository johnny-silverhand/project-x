<?php

use app\security\RegistrationForm;
use borales\extensions\phoneInput\PhoneInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model RegistrationForm */
/* @var $institutions array */
/* @var $roles array */


$this->title = 'Регистрация';
?>

<div class="container">


    <?php $form = ActiveForm::begin([
        'id' => 'registration-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            //'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            //'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'surname')->textInput()->label($model->getAttributeLabel('surname') . ' *') ?>
    <br>
    <?= $form->field($model, 'name')->textInput()->label($model->getAttributeLabel('name') . ' *') ?>
    <br>
    <?= $form->field($model, 'email')->textInput()->label('Email *') ?>
    <br>
    <?= $form->field($model, 'institution_id')->dropDownList($institutions)->label('Организация *') ?>
    <br>
    <?= $form->field($model, 'role_id')->dropDownList($roles)->label('Роль *') ?>
    <br>

    <?= $form->field($model, 'about')->textarea(['rows' => 6]) ?>
    <br>

    <?= $form->field($model, 'password')->passwordInput()->label($model->getAttributeLabel('password') . ' *') ?>
    <br>
    <?= $form->field($model, 'password_confirm')->passwordInput()->label($model->getAttributeLabel('password_confirm') . ' *') ?>
    <br>

    <div class="col-md-12 hint-block text-center">
        Поля, отмеченные звездочкой (*), обязательны для заполнения.
    </div>

    <br>
    <div class="col-md-12 text-center" style="padding-top: 20px;">
        <?= Html::submitButton('Зарегистрироваться', ['class' => 'myBtn myBtn--accent']) ?>
    </div>
    <br>

    <?php ActiveForm::end(); ?>

    <div class="col-md-12 text-center" style="padding-top: 10px;">
        Уже зарегистрированы?
        <?= Html::a('Войти', ['/site/login']) ?>
    </div>
</div>
