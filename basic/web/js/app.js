///**
// * Created by ialeksandrychev on 07.04.16.
// */

function buildSidebar(data) {
    $('.form-tag').html(data);
    initDateP();
    updatePjax();
    $('.save-note').click(function () {
        saveAdditionalData(this);
        afterNoteSave(this);
    });

    $('.pn-pn').find('input').focusout(function () {
        var el = $(this);
        el.attr('data-value', el.val());
        saveAdditionalData(el);
    });
}

function initDateP() {
    $(function () {
        $('.datetimepicker')
            .datetimepicker({format: 'MMM YYYY', focusOnShow: false})
            .on('dp.hide', function () {

                var elem = $(this).find('input');
                elem.attr('data-value', elem.val());

                saveAdditionalData(elem, '');
            });

    });
}

function updatePjax() {
    $('.update-badges-count').click();
    setTimeout("$('.update-tags-table').click();", 1000)

}


function afterNoteSave(elem) {
    var val = $(elem).attr('data-value');
    $(elem).closest('.hlrow').find('.add-note').html('Edit note').removeClass('glyphicon-plus ').addClass('glyphicon-edit');
    $(elem).closest('.hlrow').find('.db-note').find('code').html(val);
    $(elem).closest('.hlrow').find('.add-note').click();
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
        page: $(sel.anchorNode.parentNode).closest('.pf').index()  + 1,
        line_number: $(sel.anchorNode.parentNode).closest('.pf').find('.t').index($(sel.anchorNode.parentElement))  + 1,
        page_selector: $(sel.anchorNode.parentNode).closest('.pf').attr('data-page-no'),
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


    });


    $('.save-note').click(function () {
        saveAdditionalData(this);
        afterNoteSave(this);
    });
    initDateP();

    $('.pn-pn').find('input').focusout(function () {
        var el = $(this);
        el.attr('data-value', el.val());
        saveAdditionalData(el);
    });

});

$('iframe').load(function () {

    if (hlsettings.hasOwnProperty('page')) {
        $('iframe').contents().find('#page-container').css('position', 'relative');
        $('iframe').contents().find('.pc').css('display', 'block');
        $('iframe').contents().find('#sidebar').css('display', 'none');

        $('iframe').contents().find('body').scrollTop($('iframe').contents().find('#page-container').find('#pf' + hlsettings.page).position().top + parseInt(hlsettings.top))
        var iframe = document.getElementsByTagName('iframe')[0];
        var iframeDoc = iframe.contentWindow;
        iframeDoc.find(hlsettings.text);

    }
    buildLines();
});




function buildLines(){

    $('iframe').contents().find('div.pc').append('<div class="line_number pull-right"></div>');
    $('iframe').contents().find('#sidebar').remove();
    return false;
    
    $.each( $('iframe').contents().find('div.pc') , function( key, pages ) {
        $.each( $(pages).find('div.t') , function( key, div ) {
            var lineElem = $(pages).find('.line_number');

            var classList = $(div).attr('class').split(/\s+/);
            var classString = '';
            $.each(classList, function(index, item) {

                if (item.indexOf("x") != 0 ) {
                   classString = classString + ' ' + item;
                }
            });

            eh = $(div).height();
            fs = $(div).css('font-size');
            key = key + 1;
            lineElem.append('<div style="position: absolute;" class="'+ classString +'" >'+ key +'</div>');

        });
    });
}


