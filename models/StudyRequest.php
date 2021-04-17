<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "study_request".
 *
 * @property int $id
 * @property string|null $fio ФИО абитуриента
 * @property string|null $birthdate Дата рождения
 * @property int $institution_id Ид учреждения
 * @property int $specialization_id Ид направления
 * @property bool|null $budget Бюджет
 * @property bool|null $orphan Признак сироты
 * @property int|null $invalid Инвалидность
 * @property int|null $score Средний балл
 * @property int|null $rate Приоритет
 * @property bool|null $with_docs Предоставлены оригиналы документов
 * @property bool|null $invited Зачислен
 *
 * @property Institution $institution
 * @property Specialization $specialization
 */
class StudyRequest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'study_request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['birthdate'], 'safe'],
            [['institution_id', 'specialization_id', 'fio'], 'required'],
            [['institution_id', 'specialization_id', 'invalid', 'score', 'rate'], 'default', 'value' => null],
            [['institution_id', 'specialization_id', 'invalid', 'rate'], 'integer'],
            [['score'], 'number'],
            [['budget', 'orphan', 'with_docs', 'invited'], 'boolean'],
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
            'id' => 'КОД ЛЧ',
            'fio' => 'ФИО',
            'birthdate' => 'Дата рождения',
            'institution_id' => 'Учреждение',
            'specialization_id' => 'Направление',
            'budget' => 'Бюджет',
            'orphan' => 'Признак сироты',
            'invalid' => 'Инвалидность',
            'score' => 'Средний балл',
            'rate' => 'Приоритет',
            'with_docs' => 'Наличие оригиналов',
            'invited' => 'Зачислен',
        ];
    }

    /**
     * Gets query for [[Institution]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstitution()
    {
        return $this->hasOne(Institution::class, ['id' => 'institution_id']);
    }

    /**
     * Gets query for [[Specialization]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialization()
    {
        return $this->hasOne(Specialization::class, ['id' => 'specialization_id']);
    }
}
