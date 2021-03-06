<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\ar\Documents */

$this->title = $model->title;

?>


    <script>
        var hlsettings = {
            <?php if ($curHl): ?>
            top: '<?= json_decode($curHl->positions)->top - 100 ?>',
            text: '<?= strip_tags($curHl->selection)?>',
            page: '<?= json_decode($curHl->positions)->selector ?>',
            <?php endif; ?>
        }

    </script>


    <div class="documents-view">

    <h1><?= Html::encode($this->title) ?></h1>
        <?php Pjax::begin(['enablePushState' => false]); ?>
        <?= Html::a("update", [$_SERVER['REQUEST_URI']], ['class' => 'btn btn-lg btn-primary hidden update-badges-count',  ]) ?>
    <ul class="nav nav-pills">
        <li class="active"><a data-toggle="tab" href="#sectionA">
                <span class="glyphicon glyphicon-file"></span> Html View </a></li>
        <li><a data-toggle="tab" href="#sectionB"><span class="glyphicon glyphicon-calendar"></span> Dates extracted<span class="badge"><?= $model->datesCount ?></span></a></li>
        <li><a data-toggle="tab" href="#sectionC">
                <span class="glyphicon glyphicon-menu-hamburger"></span> Entities Extracted<span
                    class="badge"><?= $model->entitiesCount ?></span></a></li>
        <li><a data-toggle="tab" href="#sectionD">

                <span class="glyphicon glyphicon-tags"></span> Notes table

                <span
                    class="badge">

                    <?= count($tagResults) ?>

                </span>
              </a>

        </li>

        <li>
            <a data-toggle="tab" href="#sectionE">
                <span class="glyphicon glyphicon-random"></span> Keywords and Concepts
            </a>
        </li>

        <li>
            <a data-toggle="tab" href="#sectionF">
                <span class="glyphicon glyphicon-random"></span> Clusterizer
            </a>
        </li>

    </ul>
        <?php Pjax::end(); ?>
    <div class="tab-content">
        <div id="sectionA" class="tab-pane fade in active">
            <?= Yii::$app->controller->renderPartial('html_view', ['url' => $url, 'model' => $model, 'tagResults' => $tagResults]); ?>
        </div>
        <div id="sectionC" class="tab-pane fade">

            <table class="table">
                <thead>
                <tr>
                    <th>Entity</th>
                    <th>Type</th>
                    <th>Full Sentence</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($model->extractedEntities as $entity) { ?>
                    <tr>
                        <td><?= $entity->entity; ?></td>
                        <td><?= $entity->type; ?></td>
                        <td><?= $entity->full_sentence; ?></td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
        <div id="sectionB" class="tab-pane fade">
            <table class="table">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Full Sentence</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($model->extractedDates as $date) { ?>
                    <tr>
                        <td><?= $date->date; ?></td>
                        <td><?= $date->full_sentence; ?></td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
        <div id="sectionD" class="tab-pane fade">
            <?= Yii::$app->controller->renderPartial('tags_table',
                ['url' => $url, 'model' => $model, 'tagResults' => $tagResults]); ?>
        </div>

        <div id="sectionE" class="tab-pane fade">
            <?= Yii::$app->controller->renderPartial('keyword_concept_table',
                ['url' => $url, 'model' => $model]); ?>
        </div>

        <div id="sectionF" class="tab-pane fade">
            <?= Yii::$app->controller->renderPartial('clusterize_table',
                ['url' => $url, 'model' => $model]); ?>
        </div>

    </div>
    <div class='notifications top-right alert'></div>
<?php
$this->registerJsFile('/js/app.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/notify/bootstrap-notify.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/moment-with-locales.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerJsFile('/js/bootstrap-datetimepicker.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('/css/bootstrap-datetimepicker.css');

