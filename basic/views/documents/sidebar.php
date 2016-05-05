<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 14.04.16
 * Time: 12:22
 */
?>

<?php foreach (\app\models\ar\SentencesPlusHl::find()->where(['=','doc_id', $docId])->andWhere('tag_type = 1')->orderBy('id DESC')->all() as $hlres) { ?>
    <hr>
    <div class="hlrow">
        <div>
            <span class="ent-tag side-tag"><?= strip_tags($hlres->tag->title) ?> </span>
        </div>

        <div class="form-group" >
            <div class='input-group date datetimepicker'>
                <input data-id="<?= $hlres->id ?>" data-value="" data-field="manual_date" value="<?= $hlres->manual_date ?>"
                       type='text'
                       class="form-control"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
            </div>
        </div>

        <div class="pn-pn">
            <form class="form-inline">
                 <div class="form-group">
                    <input data-id="<?= $hlres->id ?>" data-value="" data-field="paragraph_number" type="number"
                           class="form-control"  value="<?= $hlres->paragraph_number ?>" placeholder="Paragraph">
                 </div>

            </form>
        </div>
        <br />


        <div>
            <div class="hl-area"><?= strip_tags(str_replace('</div><div','</div> <div',$hlres->sent_hl)) ?></div>
        </div>


        <button class="glyphicon glyphicon-<?= $hlres->note == '' ? 'plus' : 'edit' ?> add-note btn btn-default"
                data-toggle="collapse"
                data-target=".note-area<?= $hlres->id ?>"><?= $hlres->note == '' ? 'Add note' : 'Edit note' ?></button>
        <div class="collapse db-note note-area<?= $hlres->id ?> in">
            <code><?= $hlres->note ?></code>
        </div>
        <div class="collapse note-area<?= $hlres->id ?> ">
            <div class="form-group">
                <label for="comment">Note:</label>
            <textarea class="form-control" rows="5" onkeyup="$('.save-note').attr('data-value', $(this).val())"
                      id="note"><?= strip_tags($hlres->note) ?></textarea>
            </div>
            <button data-id="<?= $hlres->id ?>" data-value="" data-field="note"
                    class="save-note btn btn-success pull-right">save
            </button>
        </div>
        <div style="clear: both;"></div>
    </div>
<?php } ?>
