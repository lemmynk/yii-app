<?php

namespace backend\modules\menu\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\menu\models\MenuItem;

/**
 * MenuItemSearch represents the model behind the search form of `backend\modules\menu\models\MenuItem`.
 */
class MenuItemSearch extends MenuItem
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'is_parent', 'parent_id', 'status', 'created_by', 'modify_by'], 'integer'],
            [['name', 'url', 'created_on', 'modify_on'], 'safe'],
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
        $query = MenuItem::find();

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
            'category_id' => $this->category_id,
            'is_parent' => $this->is_parent,
            'parent_id' => $this->parent_id,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'created_on' => $this->created_on,
            'modify_by' => $this->modify_by,
            'modify_on' => $this->modify_on,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}
