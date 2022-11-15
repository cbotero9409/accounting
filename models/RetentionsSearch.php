<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Retentions;

/**
 * RetentionsSearch represents the model behind the search form of `app\models\Retentions`.
 */
class RetentionsSearch extends Retentions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fk_parent_retention', 'auto_calculation', 'movement_type', 'bill_to_pay', 'how_affects', 'payment_date_table', 'third_party_alias', 'expense_account', 'cost_center', 'obsolete'], 'integer'],
            [['code', 'name', 'validity_start', 'calculation_type'], 'safe'],
            [['value', 'min_base_value'], 'number'],
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
        $query = Retentions::find();

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
            'fk_parent_retention' => $this->fk_parent_retention,
            'validity_start' => $this->validity_start,
            'value' => $this->value,
            'min_base_value' => $this->min_base_value,
            'auto_calculation' => $this->auto_calculation,
            'movement_type' => $this->movement_type,
            'bill_to_pay' => $this->bill_to_pay,
            'how_affects' => $this->how_affects,
            'payment_date_table' => $this->payment_date_table,
            'third_party_alias' => $this->third_party_alias,
            'expense_account' => $this->expense_account,
            'cost_center' => $this->cost_center,
            'obsolete' => $this->obsolete,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'calculation_type', $this->calculation_type]);

        return $dataProvider;
    }
}
