@extends('layouts.auth')

@section('content')
<div class="page-content page-home">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="auth-title" data-aos="fade-up">Login</h1>

                <div class="card-body" data-aos="fade-up" data-aos-delay="100">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label class="label-auth" for="email">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="label-auth">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn-auth">
                                {{ __('Login') }}
                            </button>
                            @if (Route::has('password.request'))
                            <a class="btn btn-link btn-link-auth" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </div>
                    </form>
                    <p class="reg-auth auth-title">Belum punya akun ? <a href={{ route('register') }}>Daftar</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
