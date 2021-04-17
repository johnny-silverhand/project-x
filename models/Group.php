<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group".
 *
 * @property int $id
 * @property string $code Код специализации
 * @property int $institution_id Ид учреждения
 * @property int $specialization_id Ид направления
 *
 * @property Institution $institution
 * @property Specialization $specialization
 * @property Student[] $students
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'institution_id', 'specialization_id'], 'required'],
            [['institution_id', 'specialization_id'], 'default', 'value' => null],
            [['institution_id', 'specialization_id'], 'integer'],
            [['code'], 'string', 'max' => 255],
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
            'code' => 'Код специализации',
            'institution_id' => 'Учреждение',
            'specialization_id' => 'Направление',
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

    /**
     * Gets query for [[Students]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::class, ['group_id' => 'id']);
    }

    public static function getList(int $institutionId, $onlyFirst = false) {
        $query = self::find()->where(['institution_id' => $institutionId]);
        if($onlyFirst) {
            $query->andWhere("code like '1%'");
        }
        $models = $query->orderBy('id')->all();
        $list = [];
        foreach($models as $model) {
            $list[$model->id] = $model->code . " " . $model->specialization->name;
        }
        return $list;
    }
}
