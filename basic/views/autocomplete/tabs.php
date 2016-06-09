<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 06.06.16
 * Time: 15:57
 */
?>

<!-- Nav tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#notes" data-toggle="tab">Notes</a></li>
    <li><a href="#entities" data-toggle="tab">Entities</a></li>
    <li><a href="#articles" data-toggle="tab">Project's articles</a></li>

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
            <?php $notes = $selectedProject->getNotes(); $docId = ''; ?>
            <?php if($notes) { ?>
            <?php foreach ($notes as $r) { ?>
            <?php if($docId !=  $r->doc_id) {?>
                        <tr>
                            <th><?= $r->doc->title ?></th>
                        <th></th>
                        <th></th>
                        </tr>
             <?php }?>
                <tr>
                    <td title="↩️ Click to insert to text redactor" class="toEditor" data-document="<?= $r->doc->title ?>"><?= strip_tags(str_replace('</div><div','</div> <div',$r->sent_hl)) ?></td>
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
    <div class="tab-pane" id="articles">Project's articles</div>
</div>

<style>
    .toEditor:hover {text-decoration: underline; cursor: pointer}
    #notes {max-height: 700px; overflow-y: scroll}
</style>