<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Taxesliquidation;

/**
 * TaxesliquidationSearch represents the model behind the search form of `app\models\Taxesliquidation`.
 */
class TaxesliquidationSearch extends Taxesliquidation
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'concept', 'account_to_affect', 'third_party', 'fk_invoice', 'fk_bill'], 'integer'],
            [['base_value', 'price'], 'number'],
            [['observation', 'cc_active', 'payment_date'], 'safe'],
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
        $query = Taxesliquidation::find();

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
            'concept' => $this->concept,
            'base_value' => $this->base_value,
            'price' => $this->price,
            'account_to_affect' => $this->account_to_affect,
            'third_party' => $this->third_party,
            'payment_date' => $this->payment_date,
            'fk_invoice' => $this->fk_invoice,
            'fk_bill' => $this->fk_bill,
        ]);

        $query->andFilterWhere(['like', 'observation', $this->observation])
            ->andFilterWhere(['like', 'cc_active', $this->cc_active]);

        return $dataProvider;
    }
}
