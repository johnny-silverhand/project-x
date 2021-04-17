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
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'institution_id', 'specialization_id', 'group_id'], 'integer'],
            [['fio', 'birthdate', 'date_start', 'date_end'], 'safe'],
            [['budget'], 'boolean'],
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
            'budget' => $this->budget,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'status' => $this->status,
            'group_id' => $this->group_id,
            'g.institution_id' => $this->institution_id,
            'g.specialization_id' => $this->specialization_id,
        ]);

        $query->andFilterWhere(['ilike', 'fio', $this->fio]);

        return $dataProvider;
    }
}
