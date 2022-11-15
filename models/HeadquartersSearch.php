<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Headquarters;

/**
 * HeadquartersSearch represents the model behind the search form of `app\models\Headquarters`.
 */
class HeadquartersSearch extends Headquarters
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fk_company', 'fk_municipality', 'default_category', 'cost_center_class'], 'integer'],
            [['code', 'name', 'short_name', 'manager', 'address', 'group_class', 'start_date', 'end_date'], 'safe'],
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
        $query = Headquarters::find();

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
            'fk_company' => $this->fk_company,
            'fk_municipality' => $this->fk_municipality,
            'default_category' => $this->default_category,
            'cost_center_class' => $this->cost_center_class,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'short_name', $this->short_name])
            ->andFilterWhere(['like', 'manager', $this->manager])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'group_class', $this->group_class]);

        return $dataProvider;
    }
}
