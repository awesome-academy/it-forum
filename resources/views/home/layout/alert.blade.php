@if (Session::has('success_alert'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('success_alert') }}
        @php
        	Session::forget('success_alert')
        @endphp
    </div>
@elseif (Session::has('error_alert'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ Session::get('error_alert') }}
        @php
        	Session::forget('error_alert')
        @endphp
    </div>
@endif
