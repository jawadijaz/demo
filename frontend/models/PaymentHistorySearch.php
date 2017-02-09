<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PaymentHistory;

/**
 * PaymentHistorySearch represents the model behind the search form about `common\models\PaymentHistory`.
 */
class PaymentHistorySearch extends PaymentHistory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payment'], 'integer'],
            [['timestamp','user_from', 'user_to'], 'safe'],
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
        $query = PaymentHistory::find();
        $query->joinWith(['userTo', 'userTo']);
        // $query->joinWith(['userFrom']);
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
            'payment' => $this->payment
            //'timestamp' => $this->timestamp,
        ]);
        $query->andFilterWhere(['like', 'user.username', $this->user_to])
              ->andFilterWhere(['like', 'timestamp'  , $this->timestamp])
              ->andFilterWhere(['like', 'user.username', $this->user_from]);
              
        return $dataProvider;
    }
}
