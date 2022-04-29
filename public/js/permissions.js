$(document).ready(function (e) {

    initRadioButtons();

    $('.permission-radio').bind('change', function (e) {

        let elem = $(this);

        $.post('/users/permissions/' + $('*[user-id]').attr('user-id'), {
            resource: elem.attr('attr-resource'),
            operation: elem.attr('attr-operation'),
            permission: elem.attr('attr-value'),
        }, function (data) { 
            console.log(data); 
        });

        if(elem.attr('attr-operation') != 'create') {
            switchRadioButtons(elem);
        }

    });


    function initRadioButtons() {

        let permission_blocks = $('.permission__block');
        permission_blocks.each(function (i, block) {

            let permission_items = $(block).children().not(function (i, item) {
                if($(item).find('.permission-radio').attr('attr-operation') == 'create') {
                    return true;
                }
            });
            permission_items.each(function (e, item) {

                let value = $(item).find('.permission-radio:checked').attr('attr-value');

                let radio_btns = $(item).next().find('.permission-radio');
                radio_btns.each(function (i, radio_btn) {

                    if($(radio_btn).attr('attr-value') > value) {
                        $(radio_btn).css('visibility', 'hidden');
                    }

                })

            });

        });

    }

    function switchRadioButtons(elem) {

        let value = $(elem).attr('attr-value');

        let next_item  = $(elem).closest('.permission__item').next();
        let radio_btns = next_item.find('.permission-radio');

        radio_btns.each(function (i, radio_btn) {

            if($(radio_btn).attr('attr-value') > value) {

                $(radio_btn).css('visibility', 'hidden')

                if($(radio_btn).is(':checked')) {

                    let checked = $(radio_btn).next();
                    checked.prop('checked', true);

                    switchRadioButtons(checked);

                }

            } else {
                $(radio_btn).css('visibility', 'visible');
            }

        });

    }

});
