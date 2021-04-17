<?php

use app\models\User;
use yii\helpers\Html;
use yii\web\View;
use yii\web\YiiAsset;

/* @var $this View */
/* @var $model User */
/* @var $canEdit bool */
/* @var $canEditRoles bool */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);

$roles = [];
foreach($model->userRoles as $userRole) {
    $roles[] = Html::tag('div', Html::tag('p', $userRole->role->name) .
    Html::tag('span', Html::a('удалить', ['user-role/delete', 'id' => $userRole->id],
        [
            'data-confirm' => 'Вы уверены, что хотите удалить эту роль?',
            'data-method' => 'POST',
        ])));    
}
?>
<div class="user-view">
    <p class="content__button-wrapper">
        <?php if($canEditRoles) {
            echo Html::a('Добавить роль', ['user-role/create', 'userId' => $model->id], ['class' => 'myButton myButton--green']);
        } ?>        
        &nbsp;
        <?php if($canEdit) {
            echo Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'myButton myButton--blue']);
        } ?>        
        <!--&nbsp;
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'myButton myButton--red',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>!-->
    </p>


    <div class=" content__item content__top">
        <p class="content__name"><?= $model->surname ?> <?= $model->name ?></p>
        <div class="content__line" style="margin-top:10px">
            <div class="content__avatar-wrapper">
                <?php
                $stream = $model->image ? stream_get_contents($model->image) : false;
                if ($stream) {
                    $image = 'data:image/jpeg;charset=utf-8;base64,' . base64_encode($stream);
                    echo Html::img($image, ['style' => '...']);
                }else {
                    echo Html::img('media/no_avatar.png');
                }
                ?>
            </div>
            <div class="content__date">
                <p class="content__date-label-preview">Роли:</p>
                <?= $roles ? implode(' ', $roles) : null ?>
            </div>
        </div>
    </div>

    <div class=" content__item price">
    </div>
    <div class=" content__item price">
        <p><?= $model->getAttributeLabel('email') ?>: <span> <?= $model->email ?></span></p>
    </div>
    <div class=" content__item price">
    </div>

    <div class="content__item content__info">
        <header>О себе:</header>
        <div class="content__infoMain">
            <?= $model->about ?>
        </div>
    </div>

</div>
