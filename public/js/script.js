$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // sidebar
    $('.sidebar__close').bind('click', function (e) {

        let sidebar    = $(this).parent();
        let close_item = $(this).children();

        sidebar.toggleClass('sidebar-hidden');

        if(sidebar.hasClass('sidebar-hidden'))
        {
            close_item.html('&rsaquo;');
        } else {
            close_item.html('&lsaquo;');
        }

    });


    // tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });


    // swith activity
    $('#switch-active').bind('click', function (e) {

        let url = $(this).attr('url');

        $.post(url, '', function (data) {
            console.log(data); 
        });

    });

    // delete resource
    $('#btn-delete').bind('click', function (e) { e.preventDefault(); });
    $('#btn-sure-yes').bind('click', function (e) { $('#form-delete').submit(); });


    // search form
    $('.search-form form').submit(function (e) { e.preventDefault(); });
    $('.search-form form input').bind('input', function(e) {

        let url   = $(this).closest('form').attr('action');
        let value = $(this).val();

        $.ajax(url, {
            type: 'GET',
            data: { search: value },

            success: function (data) {
                $('tbody').html(data);
            },

        });

    });

});
