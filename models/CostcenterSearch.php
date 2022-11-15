<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Costcenter;

/**
 * CostcenterSearch represents the model behind the search form of `app\models\Costcenter`.
 */
class CostcenterSearch extends Costcenter
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'class_cc', 'fk_company', 'fk_headquarter', 'fk_cost_center'], 'integer'],
            [['code', 'name', 'short_name', 'manager', 'group_class', 'start_date', 'end_date'], 'safe'],
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
        $query = Costcenter::find();

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
            'class_cc' => $this->class_cc,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'fk_company' => $this->fk_company,
            'fk_headquarter' => $this->fk_headquarter,
            'fk_cost_center' => $this->fk_cost_center,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'short_name', $this->short_name])
            ->andFilterWhere(['like', 'manager', $this->manager])
            ->andFilterWhere(['like', 'group_class', $this->group_class]);

        return $dataProvider;
    }
}
