<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 06.06.16
 * Time: 15:57
 */
use yii\widgets\ActiveForm;
?>

<!-- Nav tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#notes" data-toggle="tab">Notes</a></li>
    <li><a href="#entities" data-toggle="tab">Entities</a></li>
    <li><a href="#articles" data-toggle="tab">Project's articles</a></li>
    <li><a href="#import" data-toggle="tab">Import entities</a></li>


</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane active" id="notes">


        <table class="table">
            <thead>
            <tr>


                <th>Highlight</th>
                <th>Note</th>
                <th>Tag</th>


            </tr>
            </thead>
            <tbody>
            <?php $notes = $selectedProject->getNotes();
            $docId = ''; ?>
            <?php if ($notes) { ?>
                <?php foreach ($notes as $r) { ?>
                    <?php if ($docId != $r->doc_id) { ?>
                        <tr>
                            <th><?= $r->doc->title ?></th>
                            <th></th>
                            <th></th>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td title="↩️ Click to insert to text redactor" class="toEditor"
                            data-document="<?= $r->doc->title ?>"><?= strip_tags(str_replace('</div><div',
                                '</div> <div', $r->text)) ?></td>
                        <td><?= $r->note ?></td>
                        <td><?= $r->tag->title ?></td>
                    </tr>
                    <?php $docId = $r->doc_id; ?>
                <?php } ?>
            <?php } ?>

            </tbody>
        </table>

    </div>


    <div class="tab-pane" id="entities">Entities</div>
    <div class="tab-pane" id="articles">

        <?php if ($selectedProject->documents) { ?>
            <br />
            <div class="btn-group" role="group" aria-label="Default button group">
            <?php foreach ($selectedProject->documents as $doc) { ?>

                <button type="button" data-url="<?= $doc->getUrlToView() ?>" class="documentOfProject btn btn-default"><?= $doc->title ?></button>
            <?php } ?>
        </div>
            <br />  <br />
        <?php } ?>
        <iframe style="display: none" id="frame" src="" name="topFrame" width="100%"
                height="700px"></iframe>

    </div>

    <div class="tab-pane" id="import">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

        <?= $form->field($importModel, 'csvFile')->fileInput() ?>

        <?= \yii\helpers\Html::submitButton('load') ?>

        <?php ActiveForm::end() ?>
    </div>
</div>

<style>
    .toEditor:hover {
        text-decoration: underline;
        cursor: pointer
    }

    #notes {
        max-height: 700px;
        overflow-y: scroll
    }
</style>