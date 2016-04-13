///**
// * Created by ialeksandrychev on 07.04.16.
// */
function getSelectionHtml(elem) {
    var html = "";
    if (typeof elem.getSelection != "undefined") {
        var sel = elem.getSelection();

        oRange = sel.getRangeAt(0); //get the text range
        oRect = oRange.getBoundingClientRect();



        if (sel.rangeCount) {
            var container = document.createElement("div");
            for (var i = 0, len = sel.rangeCount; i < len; ++i) {
                container.appendChild(sel.getRangeAt(i).cloneContents());
            }
            html = container.innerHTML;
        }
    } else if (typeof document.selection != "undefined") {
        if (document.selection.type == "Text") {
            html = document.selection.createRange().htmlText;
        }
    }
    return {'html':html ,
            position: oRect,
            page: $(sel.anchorNode.parentNode).closest('.pf').attr('data-page-no')
    };
}

$(document).ready(function(){
    $('.tagProcess').click(function(){
        var iframe = document.getElementsByTagName('iframe')[0];
        var iframeDoc = iframe.contentWindow.document;
        var selection = getSelectionHtml(iframeDoc);
        if(selection.html.length > 1){
            $.post( "/tags/selection-process", {
                'selection': selection,
                doc_id: $(this).attr('data-document-id'),
                tag_id: $(this).attr('data-tag-id')
            })
                .done(function( data ) {
                    alert( "Data Loaded: " + data );
                });
        } else {
            $.notify({
                // options
                message: 'Selection not found',
                icon: 'glyphicon glyphicon-alert',
            },{
                // settings
                type: 'danger'
            });
        }

        console.log(selection);
    });
});



//document.getElementsByTagName('iframe')[0].contentWindow.find('That alone might produce $250,000 at age 65, Heritage Foundation found in its assessment of the program')