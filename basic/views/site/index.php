<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Retain';
?>
<div class="site-index">
    <h2>Select Project</h2>
<div class="row">
<?php if($projects) {?>
    <?php foreach($projects as $p){ ?>
        <a  href="<?= \yii\helpers\Url::toRoute(['projects/view', 'id' => $p->id]) ?>" class="btn btn-primary"><?= $p->title ?></a>
    <?php } ?>
    <a class="btn btn-success" href="/projects/create"><span class="glyphicon glyphicon-plus"></span> add new project</a>
<?php } else { ?>
<p>You have to <a href="/projects/create">create the project</a> of documents </p>
<?php } ?>
</div>
</div>
