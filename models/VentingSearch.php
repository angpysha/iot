<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Venting;

/**
 * VentingSearch represents the model behind the search form about `app\models\Venting`.
 */
class VentingSearch extends Venting
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'vent_mode', 'charging', 'valve_in', 'valve_out', 'valve_cyr'], 'integer'],
            [['damp1', 'damp2', 'temp1', 'temp2', 'time_added'], 'safe'],
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
        $query = Venting::find();

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
            'vent_mode' => $this->vent_mode,
            'charging' => $this->charging,
            'valve_in' => $this->valve_in,
            'valve_out' => $this->valve_out,
            'valve_cyr' => $this->valve_cyr,
            'time_added' => $this->time_added,
        ]);

        $query->andFilterWhere(['like', 'damp1', $this->damp1])
            ->andFilterWhere(['like', 'damp2', $this->damp2])
            ->andFilterWhere(['like', 'temp1', $this->temp1])
            ->andFilterWhere(['like', 'temp2', $this->temp2]);

        return $dataProvider;
    }
}
