<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Documents */

$this->title = $model->title;

?>
<div class="documents-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <ul class="nav nav-pills">
        <li class="active"><a data-toggle="tab" href="#sectionA">
                <span class="glyphicon glyphicon-file"></span> Html View</a></li>
        <li><a data-toggle="tab" href="#sectionB"><span class="glyphicon glyphicon-calendar"></span> Dates extracted by alchemy</a></li>
        <li><a data-toggle="tab" href="#sectionC">
                <span class="glyphicon glyphicon-menu-hamburger"></span> Entities Extracted by Alchemy</a></li>

    </ul>
    <div class="tab-content">
        <div id="sectionA" class="tab-pane fade in active">
            <h3>Html View</h3>
            <iframe src="<?= $url; ?>" name="topFrame" width="100%" height="700px"></iframe>
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
                <?php foreach($model->extractedEntities as $entity){ ?>
                    <tr>
                        <td><?= $entity->entity; ?></td>
                        <td><?= $entity->type; ?></td>
                        <td><?= $entity->full_sentence; ?></td>
                    </tr>
                <?php }?>

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
                <?php foreach($model->extractedDates as $date){ ?>
                    <tr>
                        <td><?= $date->date; ?></td>
                        <td><?= $date->full_sentence; ?></td>
                    </tr>
                <?php }?>

                </tbody>
            </table>
        </div>


    </div>
