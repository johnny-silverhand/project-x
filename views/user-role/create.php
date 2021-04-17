<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserRole */
/* @var $roles array */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Добавить роль';
$this->params['breadcrumbs'][] = ['label' => 'пользователи', 'url' => ['user/index']];
$this->params['breadcrumbs'][] = ['label' => $model->user->name, 'url' => ['user/view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-role-create">

    <div class="user-role-form">

        <?php $form = ActiveForm::begin(); ?>        

        <?= $form->field($model, 'role_id')->dropDownList($roles) ?>
<br>
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'myBtn myBtn--accent']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
