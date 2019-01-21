<div id="report-modal" class="anon-vote-popup vote-popup popup custom-popup">
    <div class="popup-close">
        <a title="close this popup">×</a>
    </div>

    <h2 class="popup-title-container">
        <span class="popup-breadcrumbs"></span>
        <span class="popup-title">{{ __('page.report.thank') }}!</span>
    </h2>
    <div class="anon-vote-all">
        {!! Form::open(['id' => 'reportForm', 'class' => 'searchbar js-searchbar', 'route' => 'home.post.postReport']) !!}
        <div class="anon-vote-blurb">
            <p><span class="errors">*</span> {{ __('page.report.reason') }}</p>

            @foreach (config('constants.REPORT_MESSAGES') as $key => $report)
            {{ Form::radio('report', $key, true, ['id' => 'labelFor' . $key]) }} {!! Form::label('labelFor' . $key, __('admin.type.' . $report)) !!}
            <br>
            @endforeach
            <span class="errors" id="reportError"></span>
                {!! Form::textarea('note', null, ['id' => 'note', 'rows' => '8', 'placeholder' => __('page.report.typing') . '...']) !!}
            <p></p>
            {{ Form::hidden('post_id', $post->id) }}
        </div>
        <div class="grid fd-column gs8 gsy">
            <div class="postReport grid--cell ta-center s-btn s-btn__muted s-btn__outlined s-btn__icon">
                <svg aria-hidden="true" class="scale18 svg-icon native iconLogoGlyphXSm">
                    <g>
                        <path fill="#BCBBBB" d="M14 16v-5h2v7H2v-7h2v5z"></path>
                        <path d="M5 15v-2h8v2H5zM12.09.72l4.5 6.06-1.2.9-4.51-6.06 1.21-.9zM8.34 4.3l.97-1.16 5.8 4.83-.96 1.16-5.8-4.83zm-1.9 3.36l.64-1.37 6.85 3.19-.63 1.37-6.85-3.2zM5.4 11.39l.38-1.67 7.42 1.48-.22 1.46-7.58-1.27z" fill="#F48024"></path>
                    </g>
                </svg> {{ __('page.report.send') }}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
