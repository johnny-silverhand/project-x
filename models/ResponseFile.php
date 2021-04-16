<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Class ResponseFile
 * @package app\models
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 *
 * @property int $id
 * @property int|null $response_id ид ответа
 * @property string|null $type mime
 * @property string|null $content контент файла
 *
 * @property Response $response
 */
class ResponseFile extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'response_file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['response_id'], 'default', 'value' => null],
            [['response_id'], 'integer'],
            [['content'], 'string'],
            [['type'], 'string', 'max' => 255],
            [['response_id'], 'exist', 'skipOnError' => true, 'targetClass' => Response::class, 'targetAttribute' => ['response_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'response_id' => 'ид ответа',
            'type' => 'mime',
            'content' => 'контент файла',
        ];
    }

    /**
     * Получить отношение к [[Response]].
     *
     * @return ActiveQuery
     */
    public function getResponse(): ActiveQuery
    {
        return $this->hasOne(Response::class, ['id' => 'response_id']);
    }
}
