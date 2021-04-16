<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Class InstitutionData
 * @package app\models
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 *
 * @property int $id
 * @property int|null $institution_id ид института
 * @property int|null $category категория
 * @property string|null $name наименование сведений
 * @property string|null $value значение сведений
 * @property string|null $date время сбора данных
 *
 * @property Institution $institution
 */
class InstitutionData extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'institution_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['institution_id', 'category'], 'default', 'value' => null],
            [['institution_id', 'category'], 'integer'],
            [['date'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['value'], 'string', 'max' => 200],
            [['institution_id'], 'exist', 'skipOnError' => true, 'targetClass' => Institution::class, 'targetAttribute' => ['institution_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'institution_id' => 'ид института',
            'category' => 'категория',
            'name' => 'наименование сведений',
            'value' => 'значение сведений',
            'date' => 'время сбора данных',
        ];
    }

    /**
     * Получить отношение к [[Institution]].
     *
     * @return ActiveQuery
     */
    public function getInstitution(): ActiveQuery
    {
        return $this->hasOne(Institution::class, ['id' => 'institution_id']);
    }
}
