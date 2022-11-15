<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Chartaccounts;

/**
 * ChartaccountsSearch represents the model behind the search form of `app\models\Chartaccounts`.
 */
class ChartaccountsSearch extends Chartaccounts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'handle_third_parties', 'controls_indebtedness', 'handle_references', 'discriminate_by_third_party', 'demands_base_value', 'visible_in_selection', 'local_account', 'niif_account', 'fk_account', 'use_niif_equivalent_account', 'fk_account_type', 'class', 'fk_tax'], 'integer'],
            [['code', 'account'], 'safe'],
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
        $query = Chartaccounts::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['code' => SORT_ASC]],
            'pagination' => ['pageSize' => 25]
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
            'handle_third_parties' => $this->handle_third_parties,
            'controls_indebtedness' => $this->controls_indebtedness,
            'handle_references' => $this->handle_references,
            'discriminate_by_third_party' => $this->discriminate_by_third_party,
            'demands_base_value' => $this->demands_base_value,
            'visible_in_selection' => $this->visible_in_selection,
            'local_account' => $this->local_account,
            'niif_account' => $this->niif_account,
            'fk_account' => $this->fk_account,
            'use_niif_equivalent_account' => $this->use_niif_equivalent_account,
            'fk_account_type' => $this->fk_account_type,
            'class' => $this->class,
            'fk_tax' => $this->fk_tax,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'account', $this->account]);

        return $dataProvider;
    }
}
