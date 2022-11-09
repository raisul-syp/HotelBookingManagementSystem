@extends('layouts.auth')

@section('content')
<div class="auth-form">
    <h4 class="text-center mb-4">{{ __('Sign up your account') }}</h4>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email"><strong>{{ __('Email Address') }}</strong></label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password"><strong>{{ __('Password') }}</strong></label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <div class="form-row d-flex justify-content-between mt-4 mb-2">
            <div class="form-group">
                <div class="form-check ml-2">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                </div>
            </div>
            <div class="form-group">
                <a href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-block text-uppercase">{{ __('Sign me in') }}</button>
        </div>
    </form>

    <div class="new-account text-center mt-3">
        <p>{{ __("Don't have an account?") }} <a class="text-primary" href="{{ route('register') }}">{{ __('Sign up') }}</a></p>
    </div>
</div>
@endsection
