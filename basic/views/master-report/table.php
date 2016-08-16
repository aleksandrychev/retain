<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 18.05.16
 * Time: 13:17
 */
use yii\helpers\Html;
use yii\grid\GridView;

?>

<?php
$columns =
    [
        'user_id',
        'projectName' => [
            'attribute' => 'projectName',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::a($model->project->title, ['projects/view/' . $model->project->id]);
            },
            'filter' => Html::activeDropDownList($searchModel, 'projectName',
                \yii\helpers\ArrayHelper::map(\app\models\ar\Projects::find()->where(['user' => Yii::$app->user->id])->asArray()->all(),
                    'title', 'title'), ['class' => 'form-control multiselect', 'multiple' => true]),

        ],
        'docName' => [
            'attribute' => 'docName',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::a($model->doc->title, ['documents/view/' . $model->doc->id]);
            },
            'filter' => Html::activeDropDownList($searchModel, 'docName',
                \yii\helpers\ArrayHelper::map(\app\models\ar\Documents::find()->where(['user' => Yii::$app->user->id])->asArray()->all(),
                    'title', 'title'), ['class' => 'form-control multiselect', 'multiple' => true]),
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
                return $model->tag_type;
            },

            'filter' => Html::activeDropDownList($searchModel, 'tag_type', ['Auto' => 'Auto', 'Manual' => 'Manual'],
                ['class' => 'form-control multiselect', 'multiple' => true]),
        ],
        'entity_type' => [
            'attribute' => 'entity_type',
            'value' => 'entity_type',
            'filter' => Html::activeDropDownList($searchModel, 'entity_type',
                \yii\helpers\ArrayHelper::map(\app\models\ar\SentencesPlusHl::find()->where(['user_id' => Yii::$app->user->id])->andWhere('entity_type IS NOT NULL')->asArray()->all(),
                    'entity_type', 'entity_type'), ['class' => 'form-control multiselect', 'multiple' => true]),
        ],
        'entity' => [
            'attribute' => 'entity',
            'value' => 'entity',
            'filter' => Html::activeDropDownList($searchModel, 'entity',
                \yii\helpers\ArrayHelper::map(\app\models\ar\SentencesPlusHl::find()->where(['user_id' => Yii::$app->user->id])->andWhere('entity IS NOT NULL')->asArray()->all(),
                    'entity', 'entity'), ['class' => 'form-control multiselect', 'multiple' => true]),
        ],
        'keywordString',
        'conceptString',
        'taxonomyString',
        'send_to_final_report' => [
            'attribute' => 'send_to_final_report',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::checkbox('send_to_final_report', $model->send_to_final_report, [
                    'id' => $model->id,
                    'class' => 'send_to_final_report',
                    'data-on-color' => 'success',
                    'data-size' => 'small'
                ]);
            },

        ]
    ];

?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'layout' => '{summary}{items}',
    'emptyText' => '',
    'rowOptions' => function () {
        return ['style' => 'display: none;'];
    },
    'columns' => $columns,
]); ?>

<?php

$columns = \app\models\ar\MasterReportSettings::clearColumns($columns);

?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'id' => 'datatable',
    'summary' => '',
    'columns' => $columns,
]); ?>