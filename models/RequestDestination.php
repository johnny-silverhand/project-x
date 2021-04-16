<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Class RequestDestination
 * @package app\models
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 *
 * @property int $id
 * @property int|null $request_id ид запроса
 * @property int|null $institution_id ид института
 *
 * @property Institution $institution
 * @property Request $request
 */
class RequestDestination extends ActiveRecord
{
    public array $ids = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request_destination';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ids'], 'safe'],
            [['request_id', 'institution_id'], 'default', 'value' => null],
            [['request_id', 'institution_id'], 'integer'],
            [['institution_id'], 'exist', 'skipOnError' => true, 'targetClass' => Institution::class, 'targetAttribute' => ['institution_id' => 'id']],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => Request::class, 'targetAttribute' => ['request_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'request_id' => 'ид запроса',
            'institution_id' => 'ид института',
            'ids' => 'организации',
        ];
    }

    /**
     * Получить отношение к [[Institution]].
     *
     * @return ActiveQuery
     */
    public function getInstitution(): ActiveQuery
    {
        return $this->hasOne(Institution::class, ['id' => 'institution_id']);
    }

    /**
     * Получить отношение к [[Request]].
     *
     * @return ActiveQuery
     */
    public function getRequest(): ActiveQuery
    {
        return $this->hasOne(Request::class, ['id' => 'request_id']);
    }
}
