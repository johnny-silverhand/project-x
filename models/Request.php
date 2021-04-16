<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Class Request
 * @package app\models
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 *
 * @property int $id
 * @property string|null $name наименование
 * @property int|null $category категория
 * @property string|null $content тело запроса
 * @property string|null $date время запроса
 * @property int|null $status статус
 * @property string|null $data массив с формализованными параметрами
 *
 * @property RequestDestination[] $requestDestinations
 * @property Response[] $responses
 */
class Request extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category', 'status'], 'default', 'value' => null],
            [['category', 'status'], 'integer'],
            [['content'], 'string'],
            [['date', 'data'], 'safe'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'наименование',
            'category' => 'категория',
            'content' => 'тело запроса',
            'date' => 'время запроса',
            'status' => 'статус',
            'data' => 'запрашиваемые сведения',
            'organisations' => 'организации',
        ];
    }

    /**
     * Получить отношение к [[RequestDestination]].
     *
     * @return ActiveQuery
     */
    public function getRequestDestinations(): ActiveQuery
    {
        return $this->hasMany(RequestDestination::class, ['request_id' => 'id']);
    }

    /**
     * Получить отношение к [[Response]].
     *
     * @return ActiveQuery
     */
    public function getResponses(): ActiveQuery
    {
        return $this->hasMany(Response::class, ['request_id' => 'id']);
    }
}
