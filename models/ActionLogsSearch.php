<?php

namespace nemozar\yii2ActionLog\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use nemozar\yii2ActionLog\models\ActionLogs;

/**
 * ActionLogsSearch represents the model behind the search form of `nemozar\yii2ActionLog\models\ActionLogs`.
 */
class ActionLogsSearch extends ActionLogs
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_user'], 'integer'],
            [['time', 'url', 'post_data', 'controller', 'action', 'referer'], 'safe'],
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
        $query = ActionLogs::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_user' => $this->id_user,
        ]);

        if ($this->id) {
            $query->andWhere(['<=', 'id', $this->id]);
        }

        if ($this->time) {
            $time = explode('-', $this->time);
            $query->andWhere(['between', 'time', $time[0].' 00:00:00', $time[1].' 23:59:59']);
        }

        $query->andFilterWhere(['ilike', 'url', $this->url])
            ->andFilterWhere(['ilike', 'post_data', $this->post_data])
            ->andFilterWhere(['ilike', 'controller', $this->controller])
            ->andFilterWhere(['ilike', 'action', $this->action])
            ->andFilterWhere(['ilike', 'referer', $this->referer]);

        return $dataProvider;
    }
}
