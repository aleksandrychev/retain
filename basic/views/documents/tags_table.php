<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 14.04.16
 * Time: 15:57
 */
use yii\helpers\Html;
use yii\widgets\Pjax;
?>
<?php Pjax::begin(['enablePushState' => false]); ?>
<?= Html::a("update", [$_SERVER['REQUEST_URI']], ['class' => 'btn btn-lg btn-primary hidden update-tags-table',  ]) ?>

<table class="table">
    <thead>
    <tr>
        <th>Date</th>
        <th>Tag</th>
        <th>Highlight</th>
        <th>Note</th>
        <th>Reference</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tagResults as $r) { ?>
        <tr>
            <td><?= $r->date ?></td>
            <td><?= $r->tag->title ?></td>
            <td><?= strip_tags(str_replace('</div><div','</div> <div',$r->text)) ?></td>
            <td><?= $r->note ?></td>
            <td>Page: <?= $r->page_number ?>, <?php if($r->paragraph_number > 0){ ?>Para. <?= $r->paragraph_number ?>, <?php } ?> <?php if($r->line_number > 0){ ?>Line <?= $r->line_number ?>, <?php } ?> <a onclick="window.location = '?resId=<?= $r->id ?>'" href="?resId=<?= $r->id ?>">ref.</a></td>
        </tr>
    <?php } ?>

    </tbody>
</table>
<?php Pjax::end(); ?>