<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Class InstitutionDataSearch
 * @package app\models
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 */
class InstitutionDataSearch extends InstitutionData
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'institution_id', 'category'], 'integer'],
            [['name', 'value', 'date'], 'safe'],
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
        $query = InstitutionData::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'institution_id' => $this->institution_id,
            'category' => $this->category,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'value', $this->value]);

        return $dataProvider;
    }
}
