<?php

namespace app\helpers;

use app\models\User;
use yii\helpers\Html;
/**
 * Хелпер по работе с пользователями
 * @author restlin
 */
class UserHelper {
    public static function fio(User $user) {
        return mb_convert_case($user->name, MB_CASE_TITLE, 'UTF-8').' '.mb_convert_case($user->surname, MB_CASE_TITLE, 'UTF-8');
    }

    public static function fioLink(User $user) {
        return Html::a(self::fio($user), ['user/view', 'id' => $user->id]);
    }
}
