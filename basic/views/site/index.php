<?php


/* @var $this yii\web\View */

$this->title = 'Pdf to Html Test Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h2>PDF to HTML!</h2>


        <p><a class="btn btn-lg btn-success" href="#">upload pdf</a></p>
        <form method="POST" style="display: none" action="/load" enctype="multipart/form-data">
            <input name="pdf"  id="pdf"  type="file">
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-2.2.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('.btn-lg').click(function(){
          $('#pdf').click();
        });

        $('#pdf').change(function(){
            $(this).closest('form').submit();
        });
    });
</script>
