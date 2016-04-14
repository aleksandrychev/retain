<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 12.04.16
 * Time: 16:06
 */
?>

<h3>Html View</h3>

<div class="row">
    <div class="col-md-8">

            <iframe id="frame"  src="<?= $url; ?>" name="topFrame" width="100%"
                    height="700px"></iframe>

    </div>
    <div class="col-md-4">
        <div>
            <?php foreach (\app\models\ar\Tags::find()->all() as $tag) { ?>
                <button data-document-id="<?= $model->id ?>" data-tag-id="<?= $tag->id ?>" type="button"
                        class="btn btn-primary tagProcess"><?= $tag->title ?></button>
            <?php } ?>
        </div>

        <div class="form-tag">
<?php
if($curHl){
echo  Yii::$app->controller->renderPartial('../documents/sidebar',['hlres'=>$curHl]);
}

?>
        </div>

    </div>
</div>

