<?php

namespace app\models\ar\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ar\Documents;

/**
 * DocumentSearch represents the model behind the search form about `app\models\ar\Documents`.
 */
class DocumentSearch extends Documents
{
    public $projectName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'project_id', 'user', 'uploaded_date'], 'integer'],
            [['title', 'projectName', 'user_ip', 'user_agent', 'html_file'], 'safe'],
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
        $query = Documents::find()->where(['documents.user'=>Yii::$app->user->id]);

        $query->joinWith(['project' => function ($q) {
            $q->where('projects.title LIKE "%' . $this->projectName . '%"');
        }]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['projectName'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['projects.title' => SORT_ASC],
            'desc' => ['projects.title' => SORT_DESC],
            'label' => 'Project'
        ];


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'documents.id' => $this->id,
            'documents.project_id' => $this->project_id,
            'documents.user' => $this->user,
            'documents.uploaded_date' => $this->uploaded_date,
//            'projects.title' =>  $this->project,
        ]);

        $query->andFilterWhere(['like', 'documents.title', $this->title])
            ->andFilterWhere(['like', 'documents.user_ip', $this->user_ip])
            ->andFilterWhere(['like', 'documents.user_agent', $this->user_agent])
            ->andFilterWhere(['like', 'documents.html_file', $this->html_file]);
//            ->andFilterWhere(['like', 'projects.title', $this->project]);

        return $dataProvider;
    }
}
