<?php

use app\models\StudentSearch;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $statuses array */
/* @var $specializations array */
/* @var $institutions array */
/* @var $this View */
/* @var $model StudentSearch */
/* @var $form ActiveForm */
/* @var $invalidTypes array */

?>

<div class="student-search">

    <div class="content__formWrapper ">
        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'options' => [
                'data-pjax' => 1
            ],
        ]); ?>

            <div>
                <div class="content__contentForm">
                    <div>
                        <?= $form->field($model, 'fio') ?>
                    </div>
                    <br>
                    <div>
                        <label for="">Дата рождения</label>
                        <div class="content__dateBox">
                            <?= $form->field($model, 'birthdateStart')->label('')->widget(DatePicker::class, [
                                'language' => 'ru',
                            ]) ?>
                            <?= $form->field($model, 'birthdateEnd')->label('')->widget(DatePicker::class, [
                                'language' => 'ru',
                            ]) ?>
                        </div>
                    </div>
                    <br>
                    <div>
                        <?= $form->field($model, 'budget')->checkbox() ?>
                    </div>
                </div>
                <br>
                <div class="content__contentForm">
                    <div>
                        <label for="">Дата обучения</label>
                        <div class="content__dateBox">
                            <?= $form->field($model, 'date_start')->label('')->widget(DatePicker::class, [
                                'language' => 'ru',
                            ]) ?>
                            <?= $form->field($model, 'date_end')->label('')->widget(DatePicker::class, [
                                'language' => 'ru',
                            ]) ?>
                        </div>
                    </div>
                    <br>
                    <div>
                        <?= $form->field($model, 'status')->dropDownList(["" => ""] + $statuses) ?>
                    </div>
                    <br>
                    <div>
                        <?= $form->field($model, 'orphan')->checkbox() ?>
                    </div>
                </div>
            </div>
            <div>
                <div class="content__contentForm">
                    <div>
                        <?php echo $form->field($model, 'invalid')->dropDownList(["" => ""] + $invalidTypes) ?>
                    </div>
                    <br>
                    <div>

                        <?= $form->field($model, 'institutionIds')->label('Учреждения')->widget(Select2::class, ['data' => $institutions, 'options' => ['multiple' => true]]) ?>
                    </div>
                    <br>
                    <div>
                        <?= $form->field($model, 'specialization_id')->dropDownList(["" => ""] + $specializations) ?>
                    </div>
                    <br>
                    <div>
                        <?= $form->field($model, 'employed')->checkbox() ?>
                    </div>
                    <div>
                        <?= $form->field($model, 'mode')->dropDownList(StudentSearch::getModeList())->hiddenInput()->label('') ?>
                    </div>
                </div>
            </div>
            <br>
            <div class="content__buttonWrapper--full">
                <div class="form-group">
                    <?= Html::submitButton('Поиск', ['class' => 'myBtn myBtn--accent']) ?>
                    <?= Html::resetButton('Сброс', ['class' => 'myBtn myBtn--red']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
    </div>

</div>
