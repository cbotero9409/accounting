<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Categorylist;

/**
 * CategorylistSearch represents the model behind the search form of `app\models\Categorylist`.
 */
class CategorylistSearch extends Categorylist
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fk_headquarter'], 'integer'],
            [['cod_cc', 'name', 'short_name', 'type', 'manager', 'image'], 'safe'],
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
        $query = Categorylist::find();

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
            'fk_headquarter' => $this->fk_headquarter,
        ]);

        $query->andFilterWhere(['like', 'cod_cc', $this->cod_cc])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'short_name', $this->short_name])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'manager', $this->manager])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
