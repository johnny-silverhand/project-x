<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Student;
use yii\data\ArrayDataProvider;

/**
 * StudentSearch represents the model behind the search form of `app\models\Student`.
 */
class StudentSearch extends Student
{
    public $birthdateStart;
    public $birthdateEnd;
    public $institutionIds;
    public $specializationIds;

    public const DEFAULT_MODE = 1;
    public const CNT_MODE = 2;

    public $mode = self::DEFAULT_MODE;

    public static function getModeList(): array
    {
        return [
            self::DEFAULT_MODE => 'Стандартный поиск',
            self::CNT_MODE => 'Числовой поиск',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'institution_id', 'specialization_id', 'group_id', 'mode', 'invalid'], 'integer'],
            [['fio', 'birthdate', 'date_start', 'date_end', 'institutionIds', 'specializationIds'], 'safe'],
            [['budget', 'employed', 'orphan'], 'boolean'],
            [['birthdateStart', 'birthdateEnd'], 'date', 'format' => 'd.m.Y'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Student::find();
        $query->joinWith('group g');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'birthdate' => $this->birthdate,
            'invalid' => $this->invalid,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'status' => $this->status,
            'employed' => $this->employed,
            'orphan' => $this->orphan,
            'group_id' => $this->group_id,
            'g.institution_id' => $this->institution_id,
            'g.specialization_id' => $this->specialization_id,
        ]);

        if ($this->institutionIds) {
            $query->andFilterWhere(['g.institution_id' => $this->institutionIds]);
        }
        if ($this->specializationIds) {
            $query->andFilterWhere(['g.specialization_id' => $this->institutionIds]);
        }
        $query->andFilterWhere(['budget' => $this->budget]);

        if ($this->mode == self::CNT_MODE) {


            $query->select('g.institution_id')
                ->addSelect([
                    'cnt' => 'COUNT(*) ',
                ]);
            $query->groupBy('g.institution_id');

        }

        return $dataProvider;
    }
}
