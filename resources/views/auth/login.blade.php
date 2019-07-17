@extends('layouts.app')

@section('content')
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="{{@asset('images/logos.png')}}" class="brand_logo" >
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus class="form-control @error('email') is-invalid @enderror input_user" placeholder="{{ __('E-Mail Address') }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-key"></i></span>
                            </div>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror input_pass" name="password" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" id="customControlInline" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customControlInline">{{ __('Remember Me') }}</label>
                            </div>
                        </div> <div class="d-flex justify-content-center mt-3 login_container">
                            <button type="submit" class="btn login_btn">{{ __('Login') }}</button>
                        </div>
                    </form>
                </div>

                <div class="mt-4">
{{--                    <div class="d-flex justify-content-center links">--}}
{{--                        Don't have an account? <a href="#" class="ml-2">Sign Up</a>--}}
{{--                    </div>--}}
                    <div class="d-flex justify-content-center links">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                <button class="btn btn-primary">{{ __('Forgot Your Password?') }}</button>
                            </a>
                        @endif
                    </div>
                    <div class="text-center">NuStandards &copy; 2019-20<br><a href="https://www.nukrip.com">Nukrip Technologies Private Limited</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
