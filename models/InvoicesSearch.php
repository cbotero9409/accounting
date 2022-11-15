<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Invoices;

/**
 * InvoicesSearch represents the model behind the search form of `app\models\Invoices`.
 */
class InvoicesSearch extends Invoices
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fk_doc_type', 'class', 'fk_municipality', 'cost_center', 'third_party', 'account_cash'], 'integer'],
            [['doc_number', 'date', 'detail', 'reference'], 'safe'],
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
        $query = Invoices::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]],
            'pagination' => ['pageSize' => 10]
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
            'third_party' => $this->third_party,
            'total_price' => $this->total_price,
            'cash' => $this->cash,
            'account_cash' => $this->account_cash,
            'cash_payment_bank' => $this->cash_payment_bank,
            'bill_to_pay' => $this->bill_to_pay,
        ]);

        $query->andFilterWhere(['like', 'doc_number', $this->doc_number])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'reference', $this->reference]);

        return $dataProvider;
    }
}
