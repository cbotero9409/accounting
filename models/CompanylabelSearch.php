<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Companylabel;

/**
 * CompanylabelSearch represents the model behind the search form of `app\models\Companylabel`.
 */
class CompanylabelSearch extends Companylabel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'mt_size', 'subt_size', 'detail_size', 'footer_size', 'header_type', 'fk_company'], 'integer'],
            [['main_title', 'mt_color', 'subtitle', 'subt_color', 'detail', 'detail_color', 'footer', 'footer_color', 'logo'], 'safe'],
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
        $query = Companylabel::find();

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
            'mt_size' => $this->mt_size,
            'subt_size' => $this->subt_size,
            'detail_size' => $this->detail_size,
            'footer_size' => $this->footer_size,
            'header_type' => $this->header_type,
            'fk_company' => $this->fk_company,
        ]);

        $query->andFilterWhere(['like', 'main_title', $this->main_title])
            ->andFilterWhere(['like', 'mt_color', $this->mt_color])
            ->andFilterWhere(['like', 'subtitle', $this->subtitle])
            ->andFilterWhere(['like', 'subt_color', $this->subt_color])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'detail_color', $this->detail_color])
            ->andFilterWhere(['like', 'footer', $this->footer])
            ->andFilterWhere(['like', 'footer_color', $this->footer_color])
            ->andFilterWhere(['like', 'logo', $this->logo]);

        return $dataProvider;
    }
}
