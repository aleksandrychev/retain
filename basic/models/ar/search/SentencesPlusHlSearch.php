<?php

namespace app\models\ar\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ar\SentencesPlusHl;

/**
 * SentencesPlusHlSearch represents the model behind the search form about `app\models\ar\SentencesPlusHl`.
 */
class SentencesPlusHlSearch extends SentencesPlusHl
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'doc_id', 'tag_id', 'user_id', 'project_id', 'entity_id', 'date_id', 'page_number', 'line_number', 'paragraph_number'], 'integer'],
            [['note', 'manual_date', 'positions', 'sent_hl', 'meta_data'], 'safe'],
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
        $query = SentencesPlusHl::find();

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
            'doc_id' => $this->doc_id,
            'tag_id' => $this->tag_id,
            'user_id' => $this->user_id,
            'project_id' => $this->project_id,
            'entity_id' => $this->entity_id,
            'date_id' => $this->date_id,
            'page_number' => $this->page_number,
            'line_number' => $this->line_number,
            'paragraph_number' => $this->paragraph_number,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'manual_date', $this->manual_date])
            ->andFilterWhere(['like', 'positions', $this->positions])
            ->andFilterWhere(['like', 'sent_hl', $this->sent_hl])
            ->andFilterWhere(['like', 'meta_data', $this->meta_data]);

        return $dataProvider;
    }
}
