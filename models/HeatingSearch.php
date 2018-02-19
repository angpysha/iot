<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Heating;

/**
 * HeatingSearch represents the model behind the search form about `app\models\Heating`.
 */
class HeatingSearch extends Heating
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'heat_mode', 'charging'], 'integer'],
            [['temp_chamber', 'temp_supply', 'temp_hot', 'temp_cold', 'time_added'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Heating::find();

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
            'heat_mode' => $this->heat_mode,
            'charging' => $this->charging,
            'time_added' => $this->time_added,
        ]);

        $query->andFilterWhere(['like', 'temp_chamber', $this->temp_chamber])
            ->andFilterWhere(['like', 'temp_supply', $this->temp_supply])
            ->andFilterWhere(['like', 'temp_hot', $this->temp_hot])
            ->andFilterWhere(['like', 'temp_cold', $this->temp_cold]);

        return $dataProvider;
    }
}
