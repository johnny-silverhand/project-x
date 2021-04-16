<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Class ResponseSearch
 * @package app\models
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 */
class ResponseSearch extends Response
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'request_id', 'institution_id'], 'integer'],
            [['date', 'content', 'data'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Response::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'request_id' => $this->request_id,
            'institution_id' => $this->institution_id,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['ilike', 'content', $this->content])
            ->andFilterWhere(['ilike', 'data', $this->data]);

        return $dataProvider;
    }
}
