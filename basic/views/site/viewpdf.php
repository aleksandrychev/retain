<?php


/* @var $this yii\web\View */

$this->title = 'Pdf to Html Test Application';
?>
<div class="site-index">
<?php echo $pdfstring;?>
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
