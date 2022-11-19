@extends('layouts.auth')

@section('content')
<div class="auth-form">
    <h4 class="text-center mb-4">{{ __('Sign up your account') }}</h4>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="first_name"><strong>{{ __('First Name') }}</strong></label>
            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" required autocomplete="first_name" autofocus>
            @error('first_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="last_name"><strong>{{ __('Last Name') }}</strong></label>
            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" required autocomplete="last_name" autofocus>
            @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email"><strong>{{ __('Email Address') }}</strong></label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password"><strong>{{ __('Password') }}</strong></label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password-confirm"><strong>{{ __('Confirm Password') }}</strong></label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-block text-uppercase">{{ __('Sign me up') }}</button>
        </div>
    </form>

    <div class="new-account text-center mt-3">
        <p>{{ __('Already have an account?') }} <a class="text-primary" href="{{ route('login') }}">{{ __('Sign in') }}</a></p>
    </div>
</div>
@endsection
