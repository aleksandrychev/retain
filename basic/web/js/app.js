///**
// * Created by ialeksandrychev on 07.04.16.
// */

function buildSidebar(data) {
    $('.form-tag').html(data);
    updatePjax();
    initDateP();
}

function  initDateP(){
    $(function () {
        $('#datetimepicker1')
            .datetimepicker({format: 'DD/MM/YYYY', focusOnShow: false})
            .on('dp.hide', function(){
                var elem = $('#datetimepicker1').find('input');
                elem.attr('data-value',elem.val());

                saveAdditionalData(elem, '');
            });

    });
}

function updatePjax(){
    $('.update-badges-count').click();
    setTimeout("$('.update-tags-table').click();", 1000)
    initDateP();
}


function afterNoteSave(val){
    $('.add-note').html('Edit note').removeClass('glyphicon-plus ').addClass('glyphicon-edit');
    $('.db-note').find('code').html(val);
    $('.add-note').click();
}

function saveAdditionalData(elem, successfulCallback) {


    var data = $(elem).attr('data-value');
    if (data.length < 1) {
        $.notify({
            // options
            message: 'The Note cannot be empty',
            icon: 'glyphicon glyphicon-alert',
        }, {
            // settings
            type: 'danger'
        });

        return false;
    }

    $.post("/tags/save-additional-data", {
            'id': $(elem).attr('data-id'),
            field: $(elem).attr('data-field'),
            data: $(elem).attr('data-value')
        })
        .done(function (data) {
            if (data.error) {
                return false;
            }

            eval(successfulCallback);

            $.notify({
                // options
                message: $(elem).attr('data-field') + ' was successful saved',
            }, {
                // settings
                type: 'success'
            });
            updatePjax();
        });

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
            html = container.innerHTML;
        }
    } else if (typeof document.selection != "undefined") {
        if (document.selection.type == "Text") {
            html = document.selection.createRange().htmlText;
        }
    }
    return {
        'html': html,
        position: oRect,
        page: $(sel.anchorNode.parentNode).closest('.pf').attr('data-page-no')
    };
}

$(document).ready(function () {
    $('.tagProcess').click(function () {
        var iframe = document.getElementsByTagName('iframe')[0];
        var iframeDoc = iframe.contentWindow.document;
        var selection = getSelectionHtml(iframeDoc);
        if (selection.html.length > 1) {
            $.post("/tags/selection-process", {
                    'selection': selection,
                    doc_id: $(this).attr('data-document-id'),
                    tag_id: $(this).attr('data-tag-id')
                })
                .done(function (data) {
                    buildSidebar(data);
                    $.notify({
                        // options
                        message: 'Highlighting successful saved',
                    }, {
                        // settings
                        type: 'success'
                    });
                });
        } else {
            $.notify({
                // options
                message: 'Selection not found',
                icon: 'glyphicon glyphicon-alert',
            }, {
                // settings
                type: 'danger'
            });
        }

        console.log(selection);
    });

});

$('iframe').load(function () {

    if (hlsettings.page > 0) {
        $('iframe').contents().find('#page-container').css('position', 'relative');
        $('iframe').contents().find('.pc').css('display', 'block');
        $('iframe').contents().find('#sidebar').css('display', 'none');

        $('iframe').contents().find('body').scrollTop($('iframe').contents().find('#page-container').find('#pf' + hlsettings.page).position().top + parseInt(hlsettings.top))
        var iframe = document.getElementsByTagName('iframe')[0];
        var iframeDoc = iframe.contentWindow;
        iframeDoc.find(hlsettings.text);

    }
});


//document.getElementsByTagName('iframe')[0].contentWindow.find('That alone might produce $250,000 at age 65, Heritage Foundation found in its assessment of the program')