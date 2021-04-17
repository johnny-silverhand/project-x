<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StudyRequest;

/**
 * StudyRequestSearch represents the model behind the search form of `app\models\StudyRequest`.
 */
class StudyRequestSearch extends StudyRequest
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'institution_id', 'specialization_id', 'invalid', 'score', 'rate'], 'integer'],
            [['fio', 'birthdate'], 'safe'],
            [['budget', 'orphan', 'with_docs', 'invited'], 'boolean'],
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
        $query = StudyRequest::find();

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
            'institution_id' => $this->institution_id,
            'specialization_id' => $this->specialization_id,
            'budget' => $this->budget,
            'orphan' => $this->orphan,
            'invalid' => $this->invalid,
            'score' => $this->score,
            'rate' => $this->rate,
            'with_docs' => $this->with_docs,
            'invited' => $this->invited,
        ]);

        $query->andFilterWhere(['ilike', 'fio', $this->fio]);

        return $dataProvider;
    }
}
