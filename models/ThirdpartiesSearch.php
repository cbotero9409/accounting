<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Thirdparties;

/**
 * ThirdpartiesSearch represents the model behind the search form of `app\models\Thirdparties`.
 */
class ThirdpartiesSearch extends Thirdparties
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'doc_type', 'visible', 'juridical', 'branch_office', 'supplier', 'client', 'employee', 'seller', 'interested', 'associate', 'genre', 'processing_personal_data', 'transactional_info', 'promotional_info', 'fk_municipality', 'standard_supplier', 'payroll_entity_supplier', 'block_payments', 'payment_deadline', 'account_bank', 'account_type', 'fk_third'], 'integer'],
            [['code', 'dv', 'name', 'tradename', 'photo', 'treatment', 'profession', 'company', 'appointment', 'birthday', 'quick_code', 'address', 'account_holder', 'account_number', 'account_payment_method', 'alternate_code', 'class', 'additional_notes'], 'safe'],
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
        $query = Thirdparties::find();

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
            'doc_type' => $this->doc_type,
            'visible' => $this->visible,
            'juridical' => $this->juridical,
            'branch_office' => $this->branch_office,
            'supplier' => $this->supplier,
            'client' => $this->client,
            'employee' => $this->employee,
            'seller' => $this->seller,
            'interested' => $this->interested,
            'associate' => $this->associate,
            'genre' => $this->genre,
            'birthday' => $this->birthday,
            'processing_personal_data' => $this->processing_personal_data,
            'transactional_info' => $this->transactional_info,
            'promotional_info' => $this->promotional_info,
            'fk_municipality' => $this->fk_municipality,
            'standard_supplier' => $this->standard_supplier,
            'payroll_entity_supplier' => $this->payroll_entity_supplier,
            'block_payments' => $this->block_payments,
            'payment_deadline' => $this->payment_deadline,
            'account_bank' => $this->account_bank,
            'account_type' => $this->account_type,
            'fk_third' => $this->fk_third,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'dv', $this->dv])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'tradename', $this->tradename])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'treatment', $this->treatment])
            ->andFilterWhere(['like', 'profession', $this->profession])
            ->andFilterWhere(['like', 'company', $this->company])
            ->andFilterWhere(['like', 'appointment', $this->appointment])
            ->andFilterWhere(['like', 'quick_code', $this->quick_code])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'account_holder', $this->account_holder])
            ->andFilterWhere(['like', 'account_number', $this->account_number])
            ->andFilterWhere(['like', 'account_payment_method', $this->account_payment_method])
            ->andFilterWhere(['like', 'alternate_code', $this->alternate_code])
            ->andFilterWhere(['like', 'class', $this->class])
            ->andFilterWhere(['like', 'additional_notes', $this->additional_notes]);

        return $dataProvider;
    }
}
