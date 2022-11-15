<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Company;

/**
 * CompanySearch represents the model behind the search form of `app\models\Company`.
 */
class CompanySearch extends Company
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'doc_type', 'dv', 'e_billing_management', 'doc_platform', 'own_email_sender', 'fk_municipality', 'cxc_term', 'cxp_term', 'interest_management'], 'integer'],
            [['business_name', 'doc_number', 'short_name', 'manager', 'color', 'legal_representative', 'representative_doc', 'accountant', 'accountant_doc', 'tax_auditor', 'auditor_doc', 'address', 'electronic_billing', 'start_date', 'end_date'], 'safe'],
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
        $query = Company::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 15]
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
            'dv' => $this->dv,
            'e_billing_management' => $this->e_billing_management,
            'doc_platform' => $this->doc_platform,
            'own_email_sender' => $this->own_email_sender,
            'fk_municipality' => $this->fk_municipality,
            'cxc_term' => $this->cxc_term,
            'cxp_term' => $this->cxp_term,
            'interest_management' => $this->interest_management,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);

        $query->andFilterWhere(['like', 'business_name', $this->business_name])
            ->andFilterWhere(['like', 'doc_number', $this->doc_number])
            ->andFilterWhere(['like', 'short_name', $this->short_name])
            ->andFilterWhere(['like', 'manager', $this->manager])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'legal_representative', $this->legal_representative])
            ->andFilterWhere(['like', 'representative_doc', $this->representative_doc])
            ->andFilterWhere(['like', 'accountant', $this->accountant])
            ->andFilterWhere(['like', 'accountant_doc', $this->accountant_doc])
            ->andFilterWhere(['like', 'tax_auditor', $this->tax_auditor])
            ->andFilterWhere(['like', 'auditor_doc', $this->auditor_doc])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'electronic_billing', $this->electronic_billing]);

        return $dataProvider;
    }
}
