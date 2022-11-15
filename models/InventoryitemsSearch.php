<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Inventoryitems;

/**
 * InventoryitemsSearch represents the model behind the search form of `app\models\Inventoryitems`.
 */
class InventoryitemsSearch extends Inventoryitems
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fk_item', 'fk_third'], 'integer'],
            [['code', 'unit', 'price', 'date', 'last_price', 'last_date'], 'safe'],
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
        $query = Inventoryitems::find();

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
            'fk_item' => $this->fk_item,
            'date' => $this->date,
            'last_date' => $this->last_date,
            'fk_third' => $this->fk_third,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'last_price', $this->last_price]);

        return $dataProvider;
    }
}
