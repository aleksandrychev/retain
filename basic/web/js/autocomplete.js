/**
 * Created by ialeksandrychev on 09.06.16.
 */


function findKeysByPartValue(a, s) {
    var toReturn = []
    for (var i = 0; i < a.length; ++i) {

        if (a[i].toLowerCase().indexOf(s.toLowerCase()) == 0) {
            toReturn.push({"name": a[i]});
        }
    }
    return toReturn;
}


tinymce.init({
    selector: 'textarea',
    theme: 'modern',
    setup: function (ed) {

        ed.on('keydown', function (e) {

            if (e.which == 8) {
                string = string.slice(0, -1);
            }

        }),
            ed.on('change', function () {
                ed.save();
            });
    },
    plugins: 'mention,fullscreen',
    toolbar: 'insertfile undo redo | html | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | fullscreen',
    'formats' : {
        'alignleft' : {'selector' : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', attributes: {"align":  'left'}},
        'aligncenter' : {'selector' : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', attributes: {"align":  'center'}},
        'alignright' : {'selector' : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', attributes: {"align":  'right'}},
        'alignfull' : {'selector' : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', attributes: {"align":  'justify'}},

    },
    mentions: {
        delimiter: ['>g', '>c', '>p', '>d', '>£', '>$', '>%', '>l', '>q'],
        source: function (query, process, delimiter) {

            var sourceArr = findKeysByPartValue(entitiesArr, delimiter);

            if (sourceArr.length) {
                process(sourceArr);
            } else {
                $.post({
                    dataType: 'json',
                    method: 'POST',
                    url: '/autocomplete/mentions',
                    data: {text: delimiter, project_id: projectId},
                    success: function (data) {

                        process(data)
                    }
                });
            }


        }

    }
});


$('.savedoc').on('click', function (e) {
    e.preventDefault();

    $('#textform').attr('action', '').submit();
});

$('.htmtodocx').click(function () {

    $('#textform').attr('action', '/autocomplete/get-doc').submit();

});

function setCarretToEnd(){
    var ed = tinymce.activeEditor;
    var endId = tinymce.DOM.uniqueId();
    ed.dom.add(ed.getBody(), 'span', {'id': endId}, '');
    var newNode = ed.dom.select('span#' + endId);
    ed.selection.select(newNode[0]);
}

$(document).ready(function(){

    $('.toEditor').click(function(){
        setCarretToEnd();
        var text = ' ' + $(this).html() + ' <i>(' + $(this).attr('data-document') + ')</i>.&nbsp;';
        tinymce.execCommand('mceInsertContent',false, text);
    });

});