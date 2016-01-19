<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ToursMeta;

/**
 * ToursMetaSearch represents the model behind the search form about `app\models\ToursMeta`.
 */
class ToursMetaSearch extends ToursMeta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tour_id', 'order_sort'], 'integer'],
            [['tour_key', 'tour_value', 'description'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = ToursMeta::find();

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
            'tour_id' => $this->tour_id,
            'order_sort' => $this->order_sort,
        ]);

        $query->andFilterWhere(['like', 'tour_key', $this->tour_key])
            ->andFilterWhere(['like', 'tour_value', $this->tour_value])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
