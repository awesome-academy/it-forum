(function($) {
    'use strict';
    $('#sidebarToggle').on('click', function(e) {
        e.preventDefault();
        $('body').toggleClass('sidebar-toggled');
        $('.sidebar').toggleClass('toggled');
    });
    $('#search').on('keyup', function() {
        var $value = $(this).val();
        var search = window.location.href;
        $.ajax ({
            type: 'get',
            url: search + '/search',
            data: {
                'search': $value,
            },
            success: function(data) {
                $('tbody').html(data);
            }
        });
    });
    $.ajaxSetup({
        headers: {
            'csrftoken': '{{ csrf_token() }}' 
        }
    });
})(jQuery);
