<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Incomelist;

/**
 * IncomelistSearch represents the model behind the search form of `app\models\Incomelist`.
 */
class IncomelistSearch extends Incomelist
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fk_chart_account', 'fk_cost_center', 'fk_bill'], 'integer'],
            [['concept'], 'safe'],
            [['price'], 'number'],
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
        $query = Incomelist::find();

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
            'fk_chart_account' => $this->fk_chart_account,
            'price' => $this->price,
            'fk_cost_center' => $this->fk_cost_center,
            'fk_bill' => $this->fk_bill,
        ]);
        
        $query->andFilterWhere(['like', 'concept', $this->concept]);

        return $dataProvider;
    }
}
