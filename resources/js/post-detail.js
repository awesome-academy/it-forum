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

jQuery.fn.center = function () {
    this.css('position', 'absolute');
    this.css('top', ($(window).height() - this.height()) / 2 + $(window).scrollTop() - 100 + 'px');
    this.css('left', ($(window).width() - this.width()) / 2 + $(window).scrollLeft() + 'px');

    return this;
}

// btn report
$('body').on('click', '#btnReportPost', function (event) {
    var mousePosX = event.pageX;
    $('#report-modal').show(300).center();
});

$('body').on('click', '.popup-close', function () {
    $('#report-modal').hide(300);
});

$('body').on('click', '.postReport', function () {
    var url = $('#reportForm').attr('action');
    var formData = new FormData(document.getElementById('reportForm'));

    jQuery.ajax({

        url: url,
        type: 'POST',
        dataType: 'json',
        data: formData,
        contentType: false,
        processData: false,

        beforeSend: function() {
            $('#reportError').html('');
        },

        success: function(data, textStatus, xhr) {

            if (data.returnCode == 200) {
                $('#report-modal').hide(300);
                $('#note').val('');
                toastr.success(data.content);
            } else if (data.returnCode == 401) {
                toastr.error(data.content);
            } else if (data.returnCode == 403) {
                $('#reportError').html(data.content.note);
            }
        },
    });
});
// end btn report

$('body').on('click', '.button-follow', function() {
    var url = $(this).attr('data-action');
    var targetId = $(this).attr('data-target-id');
    var targetType = $(this).attr('data-target-type');
    var token = $('meta[name="csrf-token"]').attr('content');
    var self = $(this);

    jQuery.ajax({

        url: url,
        type: 'POST',
        dataType: 'json',
        data: {
            target_id: targetId,
            target_type: targetType,
            _token: token
        },

        success: function(data, textStatus, xhr) {

            if (data.returnCode == 200) {
                $(self).addClass('followed');
                $(self).html($('#labelTitle').attr('unfollow-title'));
                toastr.success(data.content);
            } else if (data.returnCode == 202) {
                $(self).removeClass('followed');
                $(self).html($('#labelTitle').attr('follow-title') + ' +');
                toastr.success(data.content);
            } else if (data.returnCode == 401) {
                toastr.error(data.content);
            }
        },
    });
});

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

// vote post
$('body').on('click', '.post-vote', function() {

    if ($(this).hasClass('post-vote-up') && $(this).hasClass('is-selected')) {
        $('#post-vote-score').attr('data-score', 0);
    } else if ($(this).hasClass('post-vote-up')) {
        $('#post-vote-score').attr('data-score', 1);
    } else if ($(this).hasClass('post-vote-down') && $(this).hasClass('is-selected')) {
        $('#post-vote-score').attr('data-score', 0);
    } else {
        $('#post-vote-score').attr('data-score', -1);
    }

    var url = $('#post-vote').attr('action');
    var score = $('#post-vote-score').attr('data-score');
    var formData = $('#post-vote').serialize() + '&score=' + score;

    postVote(url, formData, 'post-vote', score);
});

$('body').on('click', '.answer-vote', function() {
    var key = $(this).attr('data-key');

    if ($(this).hasClass('answer-vote-' + key + '-up') && $(this).hasClass('is-selected')) {
        $('#answer-vote-score-' + key).attr('data-score', 0);
    } else if ($(this).hasClass('answer-vote-' + key + '-up')) {
        $('#answer-vote-score-' + key).attr('data-score', 1);
    } else if ($(this).hasClass('answer-vote-' + key + '-down') && $(this).hasClass('is-selected')) {
        $('#answer-vote-score-' + key).attr('data-score', 0);
    } else {
        $('#answer-vote-score-' + key).attr('data-score', -1);
    }

    var url = $('#answer-vote-' + key).attr('action');
    var score = $('#answer-vote-score-' + key).attr('data-score');
    var formData = $('#answer-vote-' + key).serialize() + '&score=' + score;
    
    postVote(url, formData, 'answer-vote-' + key, score);
});

function postVote(url, formData, el, score) {

    jQuery.ajax({

        url: url,
        type: 'POST',
        dataType: 'json',
        data: formData,

        success: function(data, textStatus, xhr) {

            if (data.returnCode == 200) {
                changeStatus(el, score);
                var tempScore = parseInt($('.' + el + '-label').html()) + data.content.score;
                $('.' + el + '-label').html(tempScore);
            } else if (data.returnCode == 401) {
                toastr.error(data.content);
            }
        },
    });
}

function changeStatus(el, score) {
    if (score >= 1) {
        $('.' + el + '-up').addClass('is-selected');
        $('.' + el + '-down').removeClass('is-selected');
    } else if (score <= -1){
        $('.' + el + '-down').addClass('is-selected');
        $('.' + el + '-up').removeClass('is-selected');
    } else {
        $('.' + el + '-down').removeClass('is-selected');
        $('.' + el + '-up').removeClass('is-selected');
    }
}

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
        label: 'Online code',
        command: 'mySimpleCommand',
        toolbar: 'insert',
        icon: 'code_link.png',
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
    $('#' + $(this).attr('data-form')).removeClass('hidden');
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

$('body').on('click', '.vote-best-answer', function() {
    var url = $(this).attr('data-action');
    var answerId = $(this).attr('data-answer-id');
    var postId = $(this).attr('data-post-id');
    var token = $('meta[name="csrf-token"]').attr('content');
    var self = $(this);

    jQuery.ajax({

        url: url,
        type: 'POST',
        dataType: 'json',
        data: {
            answer_id: answerId,
            post_id: postId,
            _token: token
        },

        success: function(data, textStatus, xhr) {

            if (data.returnCode == 200) {
                $('.vote-best-answer').removeClass('fc-green-500');
                $(self).addClass('fc-green-500');
                toastr.success(data.content);
            } else if (data.returnCode == 202) {
                $('.vote-best-answer').removeClass('fc-green-500');
                toastr.success(data.content);
            } else if (data.returnCode == 401) {
                toastr.error(data.content);
            }
        },
    });
});
