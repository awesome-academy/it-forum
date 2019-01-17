@extends('admin.master')

@section('content')
<div class="card m-1">
    <div class="card-header">
        <h5 class="pt-sm-3 pt-md-2">
            <i class="fas fa-tachometer-alt"></i>
            {{ __('admin.category.home') }}
        </h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8 p-0 mx-0 p-lg-3">
                <canvas id="myBarChart" width="100%" height="50"></canvas>
            </div>
            <div class="col-md-4 mt-2">
                <a href="{{ route('admin.index') }}" class="btn btn-primary m-1 btnSearchAdmin">{{ __('admin.current') }}</a>
                <a href="{{ route('admin.search.week') }}" class="btn btn-primary m-1 btnSearchAdmin">{{ __('admin.thisWeek') }}</a>
                <a href="{{ route('admin.search.month') }}" class="btn btn-primary m-1 btnSearchAdmin">{{ __('admin.thisMonth') }}</a>
                {!! Form::open(['method' => 'get', 'class' => 'form-validation mt-3', 'route' => 'admin.search.custom', 'novalidate']) !!}
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            {!! Form::label('from', __('admin.from')) !!}
                            {!! Form::text('from', old('from'), ['id' => 'from', 'class' => 'form-control', 'placeholder' => '*', 'required', 'autocomplete' => 'off']) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('to', __('admin.to')) !!}
                            {!! Form::text('to', old('to'), ['id' => 'to', 'class' => 'form-control', 'placeholder' => '*', 'required', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                    {!! Form::submit(__('admin.action.search'), ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';
    var ctx = document.getElementById('myBarChart');
    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                "{{ __('admin.category.user') }}",
                "{{ __('admin.category.post') }}",
                "{{ __('admin.category.tag') }}",
                "{{ __('admin.category.report') }}",
            ],
            datasets: [{
                label: "{{ __('admin.count') }}",
                backgroundColor: 'rgba(2,117,216,1)',
                borderColor: 'rgba(2,117,216,1)',
                data: [{{ $users }}, {{ $posts }}, {{ $tags }}, {{ $reports }}],
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: 4
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: {{ $max }},
                        maxTicksLimit: 5
                    },
                    gridLines: {
                        display: true
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });
</script>
@include('admin.layout.datepicker-script')
@endsection
