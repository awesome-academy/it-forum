(function($) {
    $('#sidebarToggle').on('click', function(e) {
        e.preventDefault();
        $('body').toggleClass('sidebar-toggled');
        $('.sidebar').toggleClass('toggled');
    });
    $('#search').on('keyup',function() {
        $value = $(this).val();
        $.ajax ({
            type : 'get',
            url : '/admin/user/search',
            data : {
                'search' : $value,
            },
            success : function(data) {
                $('tbody').html(data);
            }
        });
    });
    $.ajaxSetup({
        headers : {
            'csrftoken' : '{{ csrf_token() }}' 
        }
    });
})(jQuery);
