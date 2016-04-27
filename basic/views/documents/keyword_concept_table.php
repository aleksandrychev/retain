<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 27.04.16
 * Time: 10:31
 */
?>
<div class="row">
    <div class="col-md-6">
        <?php if ($model->getExtractedKeywords()) { ?>
            <table class="table">
                <thead>
                <tr>
                    <th>Keyword</th>
                    <th>Relevance</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($model->getExtractedKeywords()->limit(5)->all() as $keyword) { ?>
                    <tr>
                        <td><?= $keyword->text ?></td>
                        <td><?= $keyword->relevance ?></td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        <?php } ?>
    </div>
    <div class="col-md-6">
        <?php if ($model->getExtractedConcepts()) { ?>
            <table class="table">
                <thead>
                <tr>
                    <th>Concept</th>
                    <th>Relevance</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($model->getExtractedConcepts()->limit(5)->all() as $keyword) { ?>
                    <tr>
                        <td><?= $keyword->text ?></td>
                        <td><?= $keyword->relevance ?></td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        <?php } ?>
    </div>
</div>