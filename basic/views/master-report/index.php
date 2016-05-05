<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ar\search\SentencesPlusHlSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Master Report';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sentences-plus-hl-index">

    <h1>Master Report</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'user_id',
            'projectName' => [
                'attribute' => 'projectName',
                'value' => 'projectName',
                'filter' => Html::activeDropDownList($searchModel, 'projectName',
                    \yii\helpers\ArrayHelper::map(\app\models\ar\Projects::find()->where(['user' => Yii::$app->user->id])->asArray()->all(),
                        'title', 'title'), ['class' => 'form-control', 'prompt' => 'Select Project']),
            ],
            'docName' => [
                'attribute' => 'docName',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->doc->title, ['documents/view/' . $model->doc->id]);
                },
                'filter' => Html::activeDropDownList($searchModel, 'docName',
                    \yii\helpers\ArrayHelper::map(\app\models\ar\Documents::find()->where(['user' => Yii::$app->user->id])->asArray()->all(),
                        'title', 'title'), ['class' => 'form-control', 'prompt' => 'Select Document']),
            ],
            'note:ntext',
            'sent_hl:ntext',
            'meta_data' => [
                'attribute' => 'meta_data',
                'format' => 'raw',
                'value' => function ($model) {
                    return 'tbc';
                },
            ],
            'reference',
            'tag_type' => [
                'attribute' => 'tag_type',
                'value' => function ($model) {
                    return $model->tag_type == 1 ? 'Manual' : 'Auto';
                },

                'filter' => Html::activeDropDownList($searchModel, 'tag_type', ['0' => 'Auto', '1' => 'Manual'],
                    ['class' => 'form-control', 'prompt' => 'Select Tag Type']),
            ],
            'entity_type' => [
                'attribute' => 'entity_type',
                'value' => 'entity_type',
                'filter' => Html::activeDropDownList($searchModel, 'entity_type',
                    \yii\helpers\ArrayHelper::map(\app\models\ar\SentencesPlusHl::find()->where(['user_id' => Yii::$app->user->id])->asArray()->all(),
                        'entity_type', 'entity_type'), ['class' => 'form-control', 'prompt' => 'Select Tag Type']),
            ],
            'entity',
            'keywordString',
            'conceptString',
            'send_to_final_report' => [
                'attribute' => 'send_to_final_report',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::checkbox('send_to_final_report' , $model->send_to_final_report, [
                        'id' =>   $model->id,
                        'class' => 'send_to_final_report',
                        'data-on-color' => 'success',
                        'data-size' => 'small'
                    ]);
                },

            ],
        ],
    ]); ?>
</div>

<?php
$js = '

 var gridview_id = ""; // specific gridview
 var columns = [5]; // index column that will grouping, start 1


var column_data = [];
column_start = [];
rowspan = [];

for (var i = 0; i < columns.length; i++) {
    column = columns[i];
    column_data[column] = "";
    column_start[column] = null;
    rowspan[column] = 1;
}

var row = 1;
$(gridview_id+" table > tbody  > tr").each(function() {
    var col = 1;
    $(this).find("td").each(function(){
        for (var i = 0; i < columns.length; i++) {
            if(col==columns[i]){
                if(column_data[columns[i]] == $(this).html()){
                    $(this).remove();
                    rowspan[columns[i]]++;
                    $(column_start[columns[i]]).attr("rowspan",rowspan[columns[i]]);
                }
                else{
                    column_data[columns[i]] = $(this).html();
                    rowspan[columns[i]] = 1;
                    column_start[columns[i]] = $(this);
                }
            }
        }
        col++;
    })
    row++;
});';

$this->registerJs($js);

$this->registerJsFile('/js/bootstrap-switch.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('/css/bootstrap-switch.css');
$this->registerJs('$(".send_to_final_report").bootstrapSwitch();');
?>


