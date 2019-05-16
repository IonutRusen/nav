@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            @lang('auth.link_sent')
                        </div>
                    @endif

                    @lang('auth.check_mail')
                    @lang('auth.not_received'), <a href="{{ route('verification.resend') }}">@lang('auth.request_new')</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
