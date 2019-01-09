toastr.options = {
    debug: false,
    positionClass: 'toast-bottom-right',
    onclick: null,
    fadeIn: 300,
    fadeOut: 1000,
    timeOut: 5000,
    extendedTimeOut: 1000
}

$(window).keydown(function(event) {

    if (!$('#inputSearch').is(':focus')) {

        if (event.keyCode == 13) {
            event.preventDefault();

            return false;
        }
    }
});

function ValidURL(str) {
    var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|'+ // domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
        '(\\#[-a-z\\d_]*)?$','i'); // fragment locater

    if (!pattern.test(str)) {
        return false;
    } else {
        return true;
    }
}

function scrollTopTo(scrollTop, speed = 'fast') {
    $('html, body').animate({scrollTop: scrollTop}, speed);
}

// post detail page
var answerBoxY = $('#answers').offset().top;
var commentBoxY = $('#comment-div').offset().top;

$('#toAnswer').on('click', function() {
    scrollTopTo(answerBoxY);
})

$('#toComment').on('click', function() {
    scrollTopTo(commentBoxY)
});

// ckeditor, answer and write page
editor = CKEDITOR.replace('editor');
if (editor) {
    CKEDITOR.on('instanceReady', function(evt) {
        evt.editor.dataProcessor.htmlFilter.addRules({
            elements: {
                img: function(el) {
                    el.addClass('img-responsive');
                }
            }
        });
    });

    editor.addCommand('mySimpleCommand', {
        exec: function(edt) {
            var person = prompt('Please enter your name');

            if (!person) {
                alert('Hãy nhập url!');
            } else if (!ValidURL(person)) {
                alert('Url không hợp lệ!');
            } else {
                edt.insertHtml('{@embed: ' + person + '}');
            }
        }
    });

    editor.ui.addButton('SuperButton', {
        label: "Click me",
        command: 'mySimpleCommand',
        toolbar: 'insert',
        icon: ''
    });
}

$('body').on('mouseenter', '.newComment', function () {
    setTimeout(function() {
        $('.newComment').removeClass('newComment');
    }, 500);
});

$('body').on('click', '.showForm', function () {
    $('.formReply').hide(100);
    $('#' + $(this).attr('data-form')).show(100);
});

$('body').on('click', '.hideForm', function () {
    $('.formReply').hide(100);
    $('.errors').html('');
});

$('body').on('click', '.postComment', function() {
    var formId = $(this).attr('data-form');
    var targetBox = $(this).attr('data-target');
    var editor = CKEDITOR.instances.editor.getData();
    var formData = new FormData(document.getElementById(formId));
    var self = $(this);
    var key = parseInt($('#keyInput').val());
    var newNumber = parseInt($('#answer-number').text());
    formData.append('post_id', $('#post_id').val());

    if ($(this).attr('data-ckeditor') == 'yes') {
        key ++;
        formData.append('content', editor);
        newNumber ++;
    }

    jQuery.ajax({

        url: $('#' + formId).attr('action'),
        type: 'POST',
        dataType: 'json',
        data: formData,
        contentType: false,
        processData: false,

        beforeSend: function() {
            $('#errorComment').html('');
            $(self).addClass('disabled');
            $('.errors').html('');
        },

        success: function(data, textStatus, xhr) {
            $(self).removeClass('disabled');

            if (data.returnCode == 200) {
                $('#' + targetBox).append(data.content);
                CKEDITOR.instances.editor.setData('');
                $('.formReply textarea').val('');
                $('#keyInput').val(key);
                $('#answer-number').html(newNumber);
                $('#toAnswer').html(newNumber);

                setTimeout(function() {
                    $('.newComment').removeClass('newComment');
                }, 3000);

                if ($(self).attr('data-ckeditor') == 'yes') {
                    scrollTopTo($('#answer-' + key).offset().top - 100);
                }
            } else if (data.returnCode == 403) {
                $('#' + formId + 'Errors').html(data.content);
            } else if (data.returnCode == 401) {
                toastr.error(data.content);
            }
        },

        complete: function() {
            $(self).removeClass('disabled');
        }
    });
});
