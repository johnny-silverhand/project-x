<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Class Role
 * @package app\models
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 *
 * @property int $id
 * @property string|null $name Наименование
 *
 * @property UserRole[] $userRoles
 */
class Role extends ActiveRecord
{
    public const ADMIN = 1;
    public const STUDENT = 2;
    public const WORKER_SUZ = 3;
    public const WORKER_DEP = 4;

    public static function getGlobalList(): array
    {
        return [
            self::STUDENT => 'абитуриент',
            self::WORKER_SUZ => 'сотрудник проф. учреждения',
            self::WORKER_DEP => 'сотрудник департамента',
            self::ADMIN => 'администратор сервиса',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * Получить отношение к [[UserRole]].
     *
     * @return ActiveQuery
     */
    public function getUserRoles(): ActiveQuery
    {
        return $this->hasMany(UserRole::class, ['role_id' => 'id']);
    }
}
