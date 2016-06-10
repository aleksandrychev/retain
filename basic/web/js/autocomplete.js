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
                ed.save()
            }) ,
            ed.on('init', function (ed) {
                setCarretToEnd();
            });
    },
    plugins: 'mention,fullscreen',
    toolbar: 'insertfile undo redo | html | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | fullscreen',
    'formats': {
        'alignleft': {'selector': 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', attributes: {"align": 'left'}},
        'aligncenter': {
            'selector': 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img',
            attributes: {"align": 'center'}
        },
        'alignright': {'selector': 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', attributes: {"align": 'right'}},
        'alignfull': {'selector': 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', attributes: {"align": 'justify'}},

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

function setCarretToEnd() {
    var ed = tinymce.activeEditor;
    var endId = tinymce.DOM.uniqueId();
    ed.dom.add(ed.getBody(), 'span', {'id': endId}, '');
    var newNode = ed.dom.select('span#' + endId);
    ed.selection.select(newNode[0]);
}


function getIframeSelection() {
    var iframe = document.getElementById('frame');
    var iframeDoc = iframe.contentWindow.document;


    var selection = getSelectionHtml(iframeDoc);
    if (selection.html.length > 1) {
        $('.ite').attr('data-text', selection.html).fadeIn('slow');

    } else {
        $('.ite').hide();
    }
}


$(document).ready(function () {

    $('#frame').contents().find('body').mouseup(function () {
        alert(1);
        getIframeSelection();
    });

    $('.toEditor').click(function () {
        var text = ' ' + $(this).html() + ' <i>(' + $(this).attr('data-document') + ')</i>.&nbsp;';
        tinymce.execCommand('mceInsertContent', false, text);
    });

    $('.documentOfProject').click(function () {
        $('#frame').attr('src', $(this).attr('data-url')).show();
        $('.ite').attr('data-document', $(this).html());

        setTimeout(function () {
            $('#frame').contents().find('#sidebar').remove();
            $('#frame').contents().find('body').mouseup(function (event) {

                getIframeSelection();
                var iframeoffset = $('#frame').offset();
                $('.ite').css({
                    'top': event.pageY + iframeoffset.top,
                    'left': event.pageX + iframeoffset.left,
                    'position': 'absolute'
                });
            });


        }, 1000);
    });

    $('.ite').click(function () {
        tinymce.execCommand('mceInsertContent', false, ' ' + $(this).attr('data-text') + ' <i>('+ $(this).attr('data-document') + ')</i>');
        $(this).hide();
        clearIframeSelection();
    });


});

function clearIframeSelection() {
    var iframe = document.getElementById('frame');
    var iframeDoc = iframe.contentWindow.document;

    if (iframeDoc.getSelection) {
        if (iframeDoc.getSelection().empty) {  // Chrome
            iframeDoc.getSelection().empty();
        } else if (iframeDoc.getSelection().removeAllRanges) {  // Firefox
            iframeDoc.getSelection().removeAllRanges();
        }
    } else if (iframeDoc.selection) {  // IE?
        iframeDoc.selection.empty();
    }
}

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
             html = $(container.innerHTML.replace(new RegExp('/div><div', 'g'), '/div> <div')).text();
        }
    } else if (typeof document.selection != "undefined") {
        if (document.selection.type == "Text") {
            html = document.selection.createRange();
        }
    }

    return {
        'html': html,
        position: oRect,
        page: $(sel.anchorNode.parentNode).closest('.pf').index() + 1,
        line_number: $(sel.anchorNode.parentNode).closest('.pf').find('.t').index($(sel.anchorNode.parentElement)) + 1,
        page_selector: $(sel.anchorNode.parentNode).closest('.pf').attr('data-page-no'),
    };
}