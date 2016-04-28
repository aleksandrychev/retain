<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Results Archive';
?>
<div class="documents-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id' => [
                'header' => 'Document ID',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->id;
                },
            ],
            'project' => [
                'header' => 'Project',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<a target="_blank" href="' . \yii\helpers\Url::toRoute(['projects/view', 'id' => $model->project->id]) . '">' . $model->project->title . '</a>';
                },
            ],
            'title' => [
                'header' => 'Document',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<a target="_blank" href="' . \yii\helpers\Url::toRoute('documents/view/' . $model->id) . '">' . $model->title . '</a>';
                },
            ],
            'entitiesCount',
            'datesCount',
        ],
    ]); ?>

</div>
