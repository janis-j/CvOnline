<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cv;

/**
 * CvSearch represents the model behind the search form of `app\models\Cv`.
 */
class CvSearch extends Cv
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'surname', 'phone', 'email', 'address', 'country', 'skills', 'languages', 'interests', 'about', 'github', 'linkedin', 'website'], 'safe'],
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
        $query = Cv::find();

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
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'skills', $this->skills])
            ->andFilterWhere(['like', 'languages', $this->languages])
            ->andFilterWhere(['like', 'interests', $this->interests])
            ->andFilterWhere(['like', 'about', $this->about])
            ->andFilterWhere(['like', 'github', $this->github])
            ->andFilterWhere(['like', 'linkedin', $this->linkedin])
            ->andFilterWhere(['like', 'website', $this->website]);

        return $dataProvider;
    }
}
