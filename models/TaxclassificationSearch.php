<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Taxclassification;

/**
 * TaxclassificationSearch represents the model behind the search form of `app\models\Taxclassification`.
 */
class TaxclassificationSearch extends Taxclassification
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fk_economic_activity', 'tax_profile', 'pn', 'pj', 'pe', 'to1', 'ts', 'rs', 'rc', 'gc', 'av', 'ar', 'ag', 'nc', 'c1', 'c2', 'c3', 'ri', 'ee', 'ie', 'ed', 'ni', 'tax_administration', 'economic_clasification', 'declarant_class', 'iva', 'ic', 'iva_inc', 'does_not_apply', 'fk_company'], 'integer'],
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
        $query = Taxclassification::find();

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
            'fk_economic_activity' => $this->fk_economic_activity,
            'tax_profile' => $this->tax_profile,
            'pn' => $this->pn,
            'pj' => $this->pj,
            'pe' => $this->pe,
            'to1' => $this->to1,
            'ts' => $this->ts,
            'rs' => $this->rs,
            'rc' => $this->rc,
            'gc' => $this->gc,
            'av' => $this->av,
            'ar' => $this->ar,
            'ag' => $this->ag,
            'nc' => $this->nc,
            'c1' => $this->c1,
            'c2' => $this->c2,
            'c3' => $this->c3,
            'ri' => $this->ri,
            'ee' => $this->ee,
            'ie' => $this->ie,
            'ed' => $this->ed,
            'ni' => $this->ni,
            'tax_administration' => $this->tax_administration,
            'economic_clasification' => $this->economic_clasification,
            'declarant_class' => $this->declarant_class,
            'iva' => $this->iva,
            'ic' => $this->ic,
            'iva_inc' => $this->iva_inc,
            'does_not_apply' => $this->does_not_apply,
            'fk_company' => $this->fk_company,
        ]);

        return $dataProvider;
    }
}
