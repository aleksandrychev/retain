<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 20.05.16
 * Time: 16:17
 */
?>

<div class="row">
    <div class="col-md-3">
        <?php if ($model->getIntellexerClusters()) { ?>
            <table class="table tree">
                <thead>
                <tr>
                    <th>Concept</th>

                </tr>
                </thead>
                <tbody>

                <?php foreach ($model->getIntellexerClusters()->all() as $cluster) { ?>
                    <tr class="treegrid-<?= $cluster->id ?> <?php  if($cluster->parent_id != 0) { ?>treegrid-parent-<?= $cluster->parent_id ?> <?php } ?>">
                        <td><a class="clusterizesel" data-ids="<?= implode(',',unserialize($cluster->sentence_ids)) ?>" ><?= $cluster->title ?></td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        <?php } ?>
    </div>
    <div class="col-md-9">
        <table class="table sentences">
            <thead>
            <tr>
                <th>Sentence</th>

            </tr>
            </thead>
            <tbody>

            <?php foreach ($model->getIntellexerSentences()->all() as $row) { ?>
                <tr style="display: none;" class="sid" data-id="<?= $row->internal_id ?>">
                    <td> <?= $row->sentence ?></td>
                </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
</div>

<?php
$this->registerJsFile('/js/jquery.treegrid.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJs("
    $(document).ready(function() {
        $('.tree').treegrid({
            expanderExpandedClass: 'glyphicon glyphicon-minus',
            expanderCollapsedClass: 'glyphicon glyphicon-plus',
            initialState: 'collapsed'
        });

        $('.clusterizesel').click(function(){

        $('.sentences .sid').hide();

         ids = $(this).attr('data-ids').split(',');
         if(ids.length){
         ids.forEach(function(id) {
            $('tr[data-id=\"'+ id +'\"]').show();
           });
         }

          });

    });

    console.log($('.tree'));
");
$this->registerCss('

.clusterizesel {cursor: pointer; border-bottom: 1px dashed;text-decoration: none;}
.clusterizesel:hover {text-decoration: none;}

.treegrid-indent {width:16px; height: 16px; display: inline-block; position: relative;}

.treegrid-expander {width:16px; height: 16px; display: inline-block; position: relative; cursor: pointer;}

.treegrid-expander-expanded{background-image: url(../img/collapse.png); }
.treegrid-expander-collapsed{background-image: url(../img/expand.png);}
');

