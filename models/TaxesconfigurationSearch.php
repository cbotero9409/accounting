<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Taxesconfiguration;

/**
 * TaxesconfigurationSearch represents the model behind the search form of `app\models\Taxesconfiguration`.
 */
class TaxesconfigurationSearch extends Taxesconfiguration
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'iva', 'retention', 'rete_ica', 'tax_cree', 'auto_retention', 'other', 'other_2', 'fk_chart_account'], 'integer'],
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
        $query = Taxesconfiguration::find();

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
            'iva' => $this->iva,
            'retention' => $this->retention,
            'rete_ica' => $this->rete_ica,
            'tax_cree' => $this->tax_cree,
            'auto_retention' => $this->auto_retention,
            'other' => $this->other,
            'other_2' => $this->other_2,
            'fk_chart_account' => $this->fk_chart_account,
        ]);

        return $dataProvider;
    }
}
