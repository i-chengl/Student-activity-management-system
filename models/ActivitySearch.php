<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Activity;

/**
 * ActivitySearch represents the model behind the search form about `app\models\Activity`.
 */
class ActivitySearch extends Activity
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['act_id', 'act_is_personal', 'act_id_submit', 'act_id_cat', 'act_state'], 'integer'],
            [['act_name', 'act_date_beg', 'act_date_end', 'act_time_submit', 'act_time_update', 'act_host', 'act_partici', 'act_attach', 'act_comment', 'act_detail'], 'safe'],
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
        $query = Activity::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'act_id' => $this->act_id,
            'act_date_beg' => $this->act_date_beg,
            'act_date_end' => $this->act_date_end,
            'act_time_submit' => $this->act_time_submit,
            'act_time_update' => $this->act_time_update,
            'act_is_personal' => $this->act_is_personal,
            'act_id_submit' => $this->act_id_submit,
            'act_id_cat' => $this->act_id_cat,
            'act_state' => $this->act_state,
        ]);

        $query->andFilterWhere(['like', 'act_name', $this->act_name])
            ->andFilterWhere(['like', 'act_host', $this->act_host])
            ->andFilterWhere(['like', 'act_partici', $this->act_partici])
            ->andFilterWhere(['like', 'act_attach', $this->act_attach])
            ->andFilterWhere(['like', 'act_comment', $this->act_comment])
            ->andFilterWhere(['like', 'act_detail', $this->act_detail]);

        return $dataProvider;
    }
}
