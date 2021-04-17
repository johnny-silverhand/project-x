<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Class Specialization
 * @package app\models
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 *
 * @property int $id
 * @property string|null $code Код специализации
 * @property string|null $name Наименование специализации
 *
 * @property Student[] $students
 */
class Specialization extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'specialization';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'string', 'max' => 255],
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
            'name' => 'Наименование специализации',
        ];
    }

    /**
     * Gets query for [[Students]].
     *
     * @return ActiveQuery
     */
    public function getStudents(): ActiveQuery
    {
        return $this->hasMany(Student::class, ['specialization_id' => 'id']);
    }
    
    public static function getList(): array {
        $list = [];
        $models = self::find()->orderBy('code')->all();
        foreach($models as $model) {
            $list[$model->id] = $model->code.' - '.$model->name;
        }
        return $list;
    }
}
