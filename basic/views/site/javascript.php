<?php


/* @var $this yii\web\View */

$this->title = 'Pdf to Html Test Application';
?>
<div style="display: none" class="site-index">

    <div class="jumbotron">
        <h2>PDF to HTML!</h2>


        <p><a class="btn btn-lg btn-success" href="#">upload pdf</a></p>
        <form method="POST" style="display: none" action="/load" enctype="multipart/form-data">
            <input name="pdf" id="pdf" type="file">
            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
        </form>
    </div>
</div>
<!--<div style="height: 800px" id="pdfRenderer"></div>-->
<script src="https://code.jquery.com/jquery-2.2.1.min.js"></script>
<script src="http://pdftohtml.loc/js/pdfobject.js"></script>
<iframe style="width: 800px;height: 800px;" id="ipdf" src="http://pdftohtml.loc:8888/test/pdfs/?frame">

</iframe>
<script>


    $(document).ready(function () {
//        $('#viewerContainer').mouseup(function (e){
//            text = window.getSelection().toString();
//           console.log(text);
//        });

          $(document).mouseup(function (e) {
              var frame = document.getElementById('ipdf');
              frame.contentWindow.postMessage('hi', '*');
//                var iframe= document.getElementById('ipdf');
//                var idoc= iframe.contentDocument || iframe.contentWindow.document; // ie compatibility
//
//                console.log(idoc);

            });


//       $("#ipdf").contents().mouseup(function (e){
//           alert(2);
//       }

    });
</script>
