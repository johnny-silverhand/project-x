<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Class User
 * @package app\models
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 *
 * @property int $id ИД
 * @property string $surname Фамилия
 * @property string $name Имя
 * @property string $email Email
 * @property string|null $password_hash Хеш пароля
 * @property string|null $about О себе
 * @property int|null $institution_id институт
 * @property string $image
 *
 * @property UserRole[] $userRoles
 * @property Institution $institution
 * @property bool $isAdmin
 * @property bool $isWorkerSuz
 * @property bool $isStudent
 * @property bool $isWorkerDep
**/
class User extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['surname', 'name', 'email'], 'required'],
            [['surname', 'name', 'email'], 'string', 'max' => 50],
            [['about'], 'string'],
            [['password_hash'], 'string', 'max' => 64],
            [['email'], 'unique'],
            [['institution_id'], 'exist', 'skipOnError' => true, 'targetClass' => Institution::class, 'targetAttribute' => ['institution_id' => 'id']],
            [['image'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'surname' => 'Фамилия',
            'name' => 'Имя',
            'email' => 'Email',
            'password_hash' => 'Хеш пароля',
            'about' => 'О себе',
            'image' => 'Фото',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getUserRoles(): ActiveQuery
    {
        return $this->hasMany(UserRole::class, ['user_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getRoles(): ActiveQuery
    {
        return $this->hasMany(Role::class, ['id' => 'role_id'])->via('userRoles');
    }

    /**
     * @return ActiveQuery
     */
    public function getInstitution(): ActiveQuery
    {
        return $this->hasOne(Institution::class, ['id' => 'institution_id']);
    }

    public function getIsAdmin(): bool
    {
        return $this->getUserRoles()->andWhere(['role_id' => Role::ADMIN])->count() ? true : false;
    }

    public function getIsStudent(): bool
    {
        return $this->getUserRoles()->andWhere(['role_id' => Role::STUDENT])->count() ? true : false;
    }

    public function getIsWorkerSuz(): bool
    {
        return $this->getUserRoles()->andWhere(['role_id' => Role::WORKER_SUZ])->count() ? true : false;
    }

    public function getIsWorkerDep(): bool
    {
        return $this->getUserRoles()->andWhere(['role_id' => Role::WORKER_DEP])->count() ? true : false;
    }

}
