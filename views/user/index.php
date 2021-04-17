<?php

use app\models\UserSearch;
use yii\data\ActiveDataProvider;
use yii\web\View;
use yii\widgets\ListView;

/* @var $this View */
/* @var $searchModel UserSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>





        <div class="content__formWrapper">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "\n{items}\n{pager}",
        'itemOptions' => ['class' => 'card card__user'],
        'options' => ['class' => 'content__content-3c'],
        'itemView' => 'itemView',
    ]) ?>

