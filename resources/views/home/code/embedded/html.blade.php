@extends('home.code.master')
@section('title','Run Code')

@section('css')
<link rel="stylesheet" href="{{ asset('css/codehtml.css') }}">
@endsection

@section('content')
{!! Form::open(['id' => 'snippetForm', 'class' => 'fontsize12px']) !!}
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" id="nav-tabs">
            <li class="active"><a href="#html" data-toggle="tab" onclick="funcChangeTab('html')">HTML</a></li>
            <li><a href="#css" data-toggle="tab" onclick="funcChangeTab('css')">CSS</a></li>
            <li><a href="#javascript" data-toggle="tab" onclick="funcChangeTab('javascript')">Javascript</a></li>
            <li>
                <a href="#result" id="btnResult" data-toggle="tab" onclick="funcChangeTab('result')">
                    {{ __('page.code.result') }}
                </a>
            </li>
            <a href="{{ route('home.code.show',$code->codename) }}" id="edit-with-editor" target="_blank" class="btn pull-right margintop3px">{{ __('page.code.editWithEditor') }}</a>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="html">
                {!! Form::textarea('html', $code->html, ['id' => 'htmlInput']) !!}
            </div>
            <div class="tab-pane" id="css">
                {!! Form::textarea('css', $code->css, ['id' => 'cssInput']) !!}
            </div>
            <div class="tab-pane" id="javascript">
                {!! Form::textarea('javascript', $code->javascript, ['id' => 'javascriptInput']) !!}
            </div>
            <div class="tab-pane" id="result">
                <div id="container-loading" class="container-loading-embedded">
                    <div class="lds-facebook"><div></div><div></div><div></div></div>
                </div>
                <iframe id="iframeResult" class="height190px" src="{{ route('home.code.execute', $code->codename) }}"
                    url-read="{{ route('home.code.read') }}" frameborder="0"></iframe>
            </div>
        </div>
    </div>
{!! Form::close() !!}
<label class="hidden">{{ __('page.code.author') }}: Phạm Tùng Lâm - phamlam9111@gmail.com</label>
@endsection

@section('js')
<script>
    var htmlEditor = CodeMirror.fromTextArea(document.getElementById('htmlInput'), {
        mode: 'text/html',
        autoCloseTags: true,
        matchTags: {bothTags: true},
    });

    var cssEditor = CodeMirror.fromTextArea(document.getElementById('cssInput'), {
        mode: 'text/css',
    });

    var javascriptEditor = CodeMirror.fromTextArea(document.getElementById('javascriptInput'), {
        mode: 'text/javascript',
    });

    htmlEditor.setSize(null, 190);
    cssEditor.setSize(null, 190);
    javascriptEditor.setSize(null, 190);

    function funcChangeTab(tagName) {

        setTimeout(function () {
            cssEditor.refresh();
            javascriptEditor.refresh();
        }, 100);
        
        if (tagName == 'result') {
            $.ajax({
                url: $('#iframeResult').attr('url-read'),
                type: 'POST',
                dataType: 'json',
                data: { 
                    html : htmlEditor.getValue(),
                    css: cssEditor.getValue(),
                    javascript: javascriptEditor.getValue(),
                    codeName : "{{ $code->codename }}",
                    _token: "{{ csrf_token() }}",
                },
                success: function(data, textStatus, xhr) {
                    if (data.returnCode == 1) {
                        loadIframe('iframeResult', $('#iframeResult').attr('src'));
                        $('#iframeResult').show();
                        $('#container-loading').hide();
                    }
                }
            });
        } else {
            $('#iframeResult').hide();
            $('#container-loading').show();
        }
    }

    function loadIframe(iframeName, url = 'execute') {
        var $iframe = $('#' + iframeName);
        if ($iframe.length) {
            $iframe.attr('src', url);

            return false;
        }

        return true;
    }
</script>
@endsection
