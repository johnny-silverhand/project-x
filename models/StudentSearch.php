<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Student;

/**
 * StudentSearch represents the model behind the search form of `app\models\Student`.
 */
class StudentSearch extends Student
{
    public $birthdateStart;
    public $birthdateEnd;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'institution_id', 'specialization_id'], 'integer'],
            [['fio', 'birthdate', 'date_start', 'date_end'], 'safe'],
            [['budget'], 'boolean'],
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
            'budget' => $this->budget,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'status' => $this->status,
            'institution_id' => $this->institution_id,
            'specialization_id' => $this->specialization_id,
        ]);

        if ($this->birthdateStart && $this->birthdateEnd) {
            $query->andFilterWhere(['between', 'birthdate', $this->birthdateStart, $this->birthdateEnd]);
        } elseif ($this->birthdateStart) {
            $query->andFilterWhere(['birthdate' => $this->birthdateStart]);
        } elseif ($this->birthdateEnd) {
            $query->andFilterWhere(['birthdate' => $this->birthdateEnd]);
        }

        $query->andFilterWhere(['ilike', 'fio', $this->fio]);

        return $dataProvider;
    }
}
