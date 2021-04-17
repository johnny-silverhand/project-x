<?php

use app\helpers\UserHelper;
use app\models\User;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var User $model */
/* @var int $key */
/* @var int $index */
/* @var ListView $widget */

?>

<div class="card">
    <div class="card__head">
        <div class="card__head-item">
            <span>Организация</span>
        </div>
        <div class="card__head-item">
                <span>Email</span>
                <span><?= $model->email ?></span>
        </div>
    </div>
    <div class="card__body">
        <div class="card__info">
            <div class="card__wrapperAvatar">
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
            </div>
            <p class="card__label"><?= UserHelper::fioLink($model); ?></p>
            <!--                            <p class="card__additional">email: <span>Bober2145@yandex.ru</span></p>-->

        </div>

        <div class="card__textWrapper">
            <p>О себе:</p>
            <div>
                <p>
                    <?= mb_strlen($model->about) > 0 ? $model->about : 'Не заполнено' ?>
                </p>
            </div>
        </div>
    </div>
</div>