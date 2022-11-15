<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Billofsale;

/**
 * BillofsaleSearch represents the model behind the search form of `app\models\Billofsale`.
 */
class BillofsaleSearch extends Billofsale
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fk_doc_type', 'class', 'fk_municipality', 'cost_center', 'client', 'seller', 'type_of_operation', 'account_cash'], 'integer'],
            [['doc_number', 'date', 'detail', 'purchase_order_number', 'observations', 'reference'], 'safe'],
            [['total_price', 'cash', 'cash_payment_bank', 'bill_to_pay'], 'number'],
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
        $query = Billofsale::find();

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
            'fk_doc_type' => $this->fk_doc_type,
            'date' => $this->date,
            'class' => $this->class,
            'fk_municipality' => $this->fk_municipality,
            'cost_center' => $this->cost_center,
            'client' => $this->client,
            'seller' => $this->seller,
            'type_of_operation' => $this->type_of_operation,
            'total_price' => $this->total_price,
            'cash' => $this->cash,
            'account_cash' => $this->account_cash,
            'cash_payment_bank' => $this->cash_payment_bank,
            'bill_to_pay' => $this->bill_to_pay,
        ]);

        $query->andFilterWhere(['like', 'doc_number', $this->doc_number])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'purchase_order_number', $this->purchase_order_number])
            ->andFilterWhere(['like', 'observations', $this->observations])
            ->andFilterWhere(['like', 'reference', $this->reference]);

        return $dataProvider;
    }
}
