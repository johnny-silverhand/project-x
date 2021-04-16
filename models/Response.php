<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Class Response
 * @package app\models
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 *
 * @property int $id
 * @property int|null $request_id ид запроса
 * @property int|null $institution_id ид института
 * @property string|null $date время сбора данных
 * @property string|null $content тело ответа
 * @property string|null $data массив с формализованными параметрами
 *
 * @property Institution $institution
 * @property Request $request
 * @property ResponseFile[] $responseFiles
 */
class Response extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'response';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['request_id', 'institution_id'], 'default', 'value' => null],
            [['request_id', 'institution_id'], 'integer'],
            [['date', 'data'], 'safe'],
            [['content'], 'string'],
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
            'date' => 'время сбора данных',
            'content' => 'ответ',
            'data' => 'массив с формализованными параметрами',
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

    /**
     * Получить отношение к [[ResponseFile]].
     *
     * @return ActiveQuery
     */
    public function getResponseFiles(): ActiveQuery
    {
        return $this->hasMany(ResponseFile::class, ['response_id' => 'id']);
    }
}
