<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Class Institution
 * @package app\models
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 *
 * @property int $id
 * @property string|null $name наименование
 * @property bool|null $is_admin
 *
 * @property InstitutionData[] $institutionDatas
 * @property RequestDestination[] $requestDestinations
 * @property Response[] $responses
 * @property User[] $users
 */
class Institution extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'institution';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_admin'], 'boolean'],
            [['name'], 'string', 'max' => 200],
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
            'is_admin' => 'Министерство',
        ];
    }

    /**
     * Получить отношение к [[InstitutionData]].
     *
     * @return ActiveQuery
     */
    public function getInstitutionDatas(): ActiveQuery
    {
        return $this->hasMany(InstitutionData::class, ['institution_id' => 'id']);
    }

    /**
     * Получить отношение к [[RequestDestination]].
     *
     * @return ActiveQuery
     */
    public function getRequestDestinations(): ActiveQuery
    {
        return $this->hasMany(RequestDestination::class, ['institution_id' => 'id']);
    }

    /**
     * Получить отношение к [[Response]].
     *
     * @return ActiveQuery
     */
    public function getResponses(): ActiveQuery
    {
        return $this->hasMany(Response::class, ['institution_id' => 'id']);
    }

    /**
     * Получить отношение к [[User]].
     *
     * @return ActiveQuery
     */
    public function getUsers(): ActiveQuery
    {
        return $this->hasMany(User::class, ['institution_id' => 'id']);
    }

    public static function getList(): array
    {
        $list = [];
        $models = self::find()->orderBy('id')->all();
        foreach ($models as $model) {
            $list[$model->id] = $model->name;
        }
        return $list;
    }
}
