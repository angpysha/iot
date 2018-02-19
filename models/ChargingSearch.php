<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Charging;

/**
 * ChargingSearch represents the model behind the search form about `app\models\Charging`.
 */
class ChargingSearch extends Charging
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'receipt_id', 'user_id'], 'integer'],
            [['started', 'finished'], 'safe'],
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
        $query = Charging::find();

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
            'receipt_id' => $this->receipt_id,
            'user_id' => $this->user_id,
            'started' => $this->started,
            'finished' => $this->finished,
        ]);

        return $dataProvider;
    }
}
