<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usr_id', 'usr_state'], 'integer'],
            [['usr_name', 'usr_passwd', 'usr_depart', 'usr_class'], 'safe'],
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
        $query = User::find();

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
            'usr_id' => $this->usr_id,
            'usr_state' => $this->usr_state,
        ]);

        $query->andFilterWhere(['like', 'usr_name', $this->usr_name])
            ->andFilterWhere(['like', 'usr_passwd', $this->usr_passwd])
            ->andFilterWhere(['like', 'usr_depart', $this->usr_depart])
            ->andFilterWhere(['like', 'usr_class', $this->usr_class]);

        return $dataProvider;
    }
}
