<?php

use app\models\User;
use yii\helpers\Html;
use yii\web\View;
use yii\web\YiiAsset;

/* @var $this View */
/* @var $model User */
/* @var $canEdit bool */
/* @var $canEditRoles bool */

$this->title = $model->name . " " . $model->surname;
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

<div class="content__avatar">
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
<br>
<ul class="content__listInfo">
    <li>
        <span><b>Роль:&nbsp;</b></span> <span><?= $roles ? implode(' ', $roles) : null ?></span>
    </li>
    <li>
        <span><b>Email:&nbsp;</b></span> <span><?= $model->email ?></span>
    </li>
    <li>
        <span><b>Профессиональная организация:&nbsp;</b></span>
        <span><?= $model->institution->name ?></span>
    </li>
    <li>
        <span><b>О себе:&nbsp;</b></span>
        <span><?= $model->about ?></span>
    </li>
</ul>
<br>
    <?php if($canEditRoles) {
        echo Html::a('Добавить роль', ['user-role/create', 'userId' => $model->id], ['class' => 'myBtn myBtn--accent']);
    } ?>
    &nbsp;
    <?php if($canEdit) {
        echo Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'myBtn myBtn--accent']);
    } ?>
    <!--&nbsp;
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
        'class' => 'myBtn myBtn--red',
        'data' => [
            'confirm' => 'Вы уверены, что хотите удалить?',
            'method' => 'post',
        ],
    ]) ?>!-->