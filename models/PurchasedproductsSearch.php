<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Purchasedproducts;

/**
 * PurchasedproductsSearch represents the model behind the search form of `app\models\Purchasedproducts`.
 */
class PurchasedproductsSearch extends Purchasedproducts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fk_third'], 'integer'],
            [['code', 'product', 'unit', 'date', 'doc_number', 'price', 'movement_type'], 'safe'],
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
        $query = Purchasedproducts::find();

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
            'date' => $this->date,
            'fk_third' => $this->fk_third,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'product', $this->product])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'doc_number', $this->doc_number])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'movement_type', $this->movement_type]);

        return $dataProvider;
    }
}
