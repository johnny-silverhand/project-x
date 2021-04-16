<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Class Student
 * @package app\models
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 *
 * @property int $id
 * @property string|null $fio ФИО Студента
 * @property string|null $birthdate Дата рождения
 * @property bool|null $budget Бюджет
 * @property string|null $date_start Дата начала обучения
 * @property string|null $date_end Дата конца обучения
 * @property int|null $status
 * @property int|null $institution_id ИД Организации
 * @property int|null $specialization_id ИД Специализации
 *
 * @property Institution $institution
 * @property Specialization $specialization
 */
class Student extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['birthdate', 'date_start', 'date_end'], 'safe'],
            [['budget'], 'boolean'],
            [['status', 'institution_id', 'specialization_id'], 'default', 'value' => null],
            [['status', 'institution_id', 'specialization_id'], 'integer'],
            [['fio'], 'string', 'max' => 100],
            [['institution_id'], 'exist', 'skipOnError' => true, 'targetClass' => Institution::class, 'targetAttribute' => ['institution_id' => 'id']],
            [['specialization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Specialization::class, 'targetAttribute' => ['specialization_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'ФИО Студента',
            'birthdate' => 'Дата рождения',
            'budget' => 'Бюджет',
            'date_start' => 'Дата начала обучения',
            'date_end' => 'Дата конца обучения',
            'status' => 'Status',
            'institution_id' => 'ИД Организации',
            'specialization_id' => 'ИД Специализации',
        ];
    }

    /**
     * Gets query for [[Institution]].
     *
     * @return ActiveQuery
     */
    public function getInstitution(): ActiveQuery
    {
        return $this->hasOne(Institution::class, ['id' => 'institution_id']);
    }

    /**
     * Gets query for [[Specialization]].
     *
     * @return ActiveQuery
     */
    public function getSpecialization(): ActiveQuery
    {
        return $this->hasOne(Specialization::class, ['id' => 'specialization_id']);
    }
}