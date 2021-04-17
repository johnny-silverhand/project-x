<?php

namespace app\models;

use app\repositories\Repository;
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
            'name' => 'Наименование',
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

    public function getCountInvalid(): int
    {
        $query = Student::find()->andWhere(['invalid' => [Repository::INVALID_1, Repository::INVALID_2, Repository::INVALID_3]]);
        $query->joinWith('group g');
        $query->andWhere(['g.institution_id' => $this->id]);
        return $query->count();
    }

    public function getCountOrphan(): int
    {
        $query = Student::find()->andWhere(['orphan' => true]);
        $query->joinWith('group g');
        $query->andWhere(['g.institution_id' => $this->id]);
        return $query->count();
    }

    public function getCountBudget(): int
    {
        $query = Student::find()->andWhere(['budget' => true]);
        $query->joinWith('group g');
        $query->andWhere(['g.institution_id' => $this->id]);
        return $query->count();
    }

    public function getCountNotBudget(): int
    {
        $query = Student::find()->andWhere(['budget' => false]);
        $query->joinWith('group g');
        $query->andWhere(['g.institution_id' => $this->id]);
        return $query->count();
    }

}
