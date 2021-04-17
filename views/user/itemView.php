<?php

use app\helpers\UserHelper;
use app\models\User;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var User $model */
/* @var int $key */
/* @var int $index */
/* @var ListView $widget */

/**/

?>

<ul class="card__list-body">
    <!--                            title не забудь!-->
    <div class="card__avatar">
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
    <br/>
    <div class="card__name"> <?= UserHelper::fioLink($model) ?></div>
    <br/>
    <div class="card__info">
        <li>
            <span><b>Email:&nbsp;</b></span>
            <span><?= $model->email ?></span>
        </li>
        <li>
            <span><b>Профессиональная организация:&nbsp;</b></span>
            <span><?= $model->institution->name ?></span>
        </li>
        <li class="card__about">
            <span><b>О себе:&nbsp;</b></span>
            <span><?= $model->about ?></span>
        </li>
    </div>
</ul>
<br/>
<div class="card__btnWrapper card__btnWrapper--end">
    <?= Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'myBtn myBtn--accent']) ?>
</div>