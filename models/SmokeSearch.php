<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Smoke;

/**
 * SmokeSearch represents the model behind the search form about `app\models\Smoke`.
 */
class SmokeSearch extends Smoke
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'location'], 'integer'],
            [['fume', 'temp', 'time'], 'safe'],
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
        $query = Smoke::find();

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
            'location' => $this->location,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'fume', $this->fume])
            ->andFilterWhere(['like', 'temp', $this->temp]);

        return $dataProvider;
    }
}
