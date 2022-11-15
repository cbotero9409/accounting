<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Billtopay;

/**
 * BilltopaySearch represents the model behind the search form of `app\models\Billtopay`.
 */
class BilltopaySearch extends Billtopay
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'third_party', 'account', 'fk_inovice', 'fk_bill'], 'integer'],
            [['date_to_pay', 'number_of_fees'], 'safe'],
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
        $query = Billtopay::find();

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
            'third_party' => $this->third_party,
            'account' => $this->account,
            'date_to_pay' => $this->date_to_pay,
            'fk_inovice' => $this->fk_inovice,
            'fk_bill' => $this->fk_bill,
        ]);

        $query->andFilterWhere(['like', 'number_of_fees', $this->number_of_fees]);

        return $dataProvider;
    }
}
