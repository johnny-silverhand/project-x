<?php

use app\models\UserSearch;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;

/* @var $this View */
/* @var $model UserSearch */
/* @var $form ActiveForm */

?>


<?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    //'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n{input}\n",
        'horizontalCssClasses' => [
            'label' => '',
            'offset' => '',
            'wrapper' => '',
            'error' => '',
            'hint' => '',
        ],
    ],
    'options' => [
        'data-pjax' => 1,
    ],
]); ?>


            <?= $form->field($model, 'name')->textInput(['class' => 'form-control myForm']) ?>
            <?= $form->field($model, 'surname')->textInput(['class' => 'form-control myForm']) ?>
            <?= $form->field($model, 'email')->textInput(['class' => 'form-control myForm']) ?>
        <button class="myBtn myBtn--accent">Поиск</button>

<?php ActiveForm::end(); ?>
