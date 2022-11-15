<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Contacts;

/**
 * ContactsSearch represents the model behind the search form of `app\models\Contacts`.
 */
class ContactsSearch extends Contacts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fk_supplier', 'fk_company', 'fk_headquarter'], 'integer'],
            [['name', 'person_type', 'cell_phone', 'phone', 'email', 'address', 'web_page'], 'safe'],
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
        $query = Contacts::find();

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
            'fk_supplier' => $this->fk_supplier,
            'fk_company' => $this->fk_company,
            'fk_headquarter' => $this->fk_headquarter,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'person_type', $this->person_type])
            ->andFilterWhere(['like', 'cell_phone', $this->cell_phone])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'web_page', $this->web_page])
            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
