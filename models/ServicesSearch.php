<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Services;

/**
 * ServicesSearch represents the model behind the search form of `app\models\Services`.
 */
class ServicesSearch extends Services
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fk_company', 'fk_type', 'fk_municipality', 'fk_tax'], 'integer'],
            [['name', 'reference', 'clasification', 'construction', 'unit', 'data_sheet'], 'safe'],
            [['unit_price', 'total_price'], 'number'],
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
        $query = Services::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 3]
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
            'unit_price' => $this->unit_price,
            'total_price' => $this->total_price,
            'fk_company' => $this->fk_company,
            'fk_type' => $this->fk_type,
            'fk_municipality' => $this->fk_municipality,
            'fk_tax' => $this->fk_tax,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'reference', $this->reference])
            ->andFilterWhere(['like', 'clasification', $this->clasification])
            ->andFilterWhere(['like', 'construction', $this->construction])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'data_sheet', $this->data_sheet]);

        return $dataProvider;
    }
}
