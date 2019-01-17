@extends('home.code.master')
@section('title','Run Code')

@section('css')
<link rel="stylesheet" href="{{ asset('css/codephp.css') }}">
@endsection

@section('content')
    <section class="container-fluid padding0px" id="container">
        <div class="col-xs-6" id="container-php">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs bgpurple">
                    <li class="active"><a href="#php" data-toggle="tab">{{ __('page.code.php') }}</a></li>
                    <div class="btn btn-danger" id="openfile">{{ __('page.code.openFile') }}</div>
                    {!! Form::file('file', ['class' => 'hidden', 'id' => 'file']) !!}
                    {!! Form::button(__('page.code.run'), ['class' => 'btn btn-success', 'id' => 'btnRun', 'url-read' => route('home.code.readPhp'), 'code-name' => $code->codename, 'data-token' => csrf_token()]) !!}
                </ul>
                <div class="tab-content" id="tab-content-php">
                    <div class="tab-pane active">
                        <div class="container-fluid">
                            <div class="row">
                                {!! Form::textarea('CodeInput', (isset($code->php)) ? $code->php : 'echo \'Hello!\';', ['id' => 'codeinput', 'class' => 'form-control', 'autofocus']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 padding0px">
            <div class="clearfix"></div>
            <div class="nav-tabs-custom" >
                <ul class="nav nav-tabs bgpurple">
                    <li class="active"><a href="#php" data-toggle="tab">{{ __('page.code.result') }}</a></li>
                    <a href="{{ route('home.code.show',$code->codename) }}" id="edit-with-editor" target="_blank" class="btn pull-right margintop3px">{{ __('page.code.editWithEditor') }}</a>
                </ul>
                <div class="tab-content padding0px" id="tab-content-php-result">
                    <div class="tab-pane active">
                        <div class="col-lg-12 padding0px">
                            {!! Form::textarea('CodeOutput', (isset($source)) ? $source : '', ['id' => 'codeoutput', 'class' => 'form-control', 'readonly']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <label class="hidden">{{ __('page.code.author') }}: Phạm Tùng Lâm - phamlam9111@gmail.com</label>
    </section>
@endsection

@section('js')
<script>
    $(document).ready(function() {

        $('#openfile').click(function(){
            $('#file').click();
        });

        var editor = CodeMirror.fromTextArea(document.getElementById('codeinput'), {
            lineNumbers : false,
            matchBrackets: true,
            mode: 'text/x-php',
            indentUnit: 4,
            indentWithTabs: true,
        });

        editor.setSize(null, 200);

        $('#btnRun').click(function(){
            $(this).addClass('disabled');

            jQuery.ajax({
                url: $(this).attr('url-read'),
                type: 'POST',
                dataType: 'json',
                data: { 
                    codeInput : editor.getValue(),
                    codeName : $(this).attr('code-name'),
                    _token : $(this).attr('data-token')
                },

                success: function(data, textStatus, xhr) {

                    if (data.returnCode == 1) {
                        $('#codeoutput').val(data.data);
                    }
                    $('#btnRun').removeClass('disabled');
                },

                error: function(xhr, textStatus, errorThrown) {
                    $('#btnRun').removeClass('disabled');
                }
            });
        });

        document.getElementById('file').onchange = function() {
            var file = this.files[0];
            var sFileName = file.name;
            var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
            var types = ['php', 'txt', 'js', 'css', 'html'];

            if (file.size / 1024 < 1000 && types.indexOf(sFileExtension) >= 0) {
                var reader = new FileReader();
                reader.onload = function(progressEvent) {
                    // By lines
                    var lines = this.result.split('\n');
                    var allFile = '';

                    for (var line = 0; line < lines.length; line++) {
                        allFile += lines[line] + '\n';
                    }
                    editor.setValue(allFile);
                };
                reader.readAsText(file);
            } else {
                alert('{{ __('page.code.errorFormat') }}!');
            }
        };
    });
</script>
@endsection
