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
    (function() {
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('form-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    (function() {
        $('body').addClass('users-page unified-theme');
        $('.alert-dismissible').fadeTo(3000, 500).slideUp(500, function() {
            $('.alert-dismissible').alert('close');
        })
    })();
})(jQuery);
