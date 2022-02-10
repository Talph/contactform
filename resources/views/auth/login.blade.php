@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header">
                    <h3>{{ __('Login') }}</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">

                            <div class="col-md-12">
                                <label for="email" class="col-md-4 col-form-label ">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <label for="password" class="col-md-4 col-form-label ">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{
                                        old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn w-100 btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>

                    </form>
                    <small>By clicking the "Login" button, you consent to the use of
                        cookies and similar technologies described in our
                        <a href="#">Cookie & Privacy Policy.</a></small>


                    <div class="row mt-3">
                        <div class="col-md-6">
                            <span class="fw-bold">Login:</span> admin@admin.com
                        </div>
                        <div class="col-md-6">
                            <span class="fw-bold">Password:</span> password
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection