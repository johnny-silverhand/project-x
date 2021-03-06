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
 * @property int|null $status Статус обучения
 * @property bool|null $orphan Является сиротой
 * @property int|null $invalid инвалидность
 * @property bool|null $employed трудоустроен после окончания
 * @property int|null $group_id ИД Группы
 *
 * @property Group $group
 */
class Student extends ActiveRecord
{
    public $institution_id;
    public $specialization_id;
    public $content = '';

    public $cntBudget = 0;
    public $cntOrphan = 0;
    public $cntEmployed = 0;

    public $cnt = 0;
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
            [['fio', 'birthdate', 'date_start', 'date_end', 'group_id', 'status'], 'required'],
            [['birthdate', 'date_start', 'date_end'], 'safe'],
            [['budget', 'orphan', 'employed'], 'boolean'],
            [['status', 'group_id'], 'default', 'value' => null],
            [['status', 'group_id', 'invalid'], 'integer'],
            [['fio'], 'string', 'max' => 100],
            [['content'], 'string', 'max' => 8000],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::class, 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Код',
            'fio' => 'ФИО',
            'birthdate' => 'Дата рождения',
            'budget' => 'Бюджет',
            'cntBudget' => 'Бюджет',
            'date_start' => 'Дата начала обучения',
            'date_end' => 'Дата конца обучения',
            'status' => 'Статус',
            'institution_id' => 'Учреждение',
            'specialization_id' => 'Направление',
            'group_id' => 'Группа',
            'orphan' => 'Является сиротой',
            'cntOrphan' => 'Является сиротой',
            'invalid' => 'Инвалидность',
            'employed' => 'Трудоустроен после обучения',
            'cntEmployed' => 'Трудоустроен после обучения',
            'content' => 'Неформализованные данные'
        ];
    }

    /**
     * Gets query for [[Group]].
     *
     * @return ActiveQuery
     */
    public function getGroup(): ActiveQuery
    {
        return $this->hasOne(Group::class, ['id' => 'group_id']);
    }
}
