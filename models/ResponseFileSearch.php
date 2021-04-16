<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Class ResponseFileSearch
 * @package app\models
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 */
class ResponseFileSearch extends ResponseFile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'response_id'], 'integer'],
            [['type', 'content'], 'safe'],
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
        $query = ResponseFile::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'response_id' => $this->response_id,
        ]);

        $query->andFilterWhere(['ilike', 'type', $this->type])
            ->andFilterWhere(['ilike', 'content', $this->content]);

        return $dataProvider;
    }
}
