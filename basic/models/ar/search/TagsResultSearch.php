<?php

namespace app\models\ar\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ar\TagsResult;

/**
 * TagsResultSearch represents the model behind the search form about `app\models\ar\TagsResult`.
 */
class TagsResultSearch extends TagsResult
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'doc_id', 'tag_id', 'user_id', 'page_number', 'line_number', 'paragraph_number'], 'integer'],
            [['text', 'html', 'note', 'date', 'positions'], 'safe'],
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
        $query = TagsResult::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, '');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
//            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'doc_id' => $this->doc_id,
            'tag_id' => $this->tag_id,
            'user_id' => $this->user_id,
            'page_number' => $this->page_number,
            'line_number' => $this->line_number,
            'paragraph_number' => $this->paragraph_number,
        ]);

        $query->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'html', $this->html])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'positions', $this->positions]);

        return $dataProvider;
    }
}
