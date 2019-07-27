@extends('layouts.app')
@section('content')
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card h-50" @if($isset)style="background-color: white; height: 55%!important;"@endif>
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="{{@asset('images/logos.png')}}" class="brand_logo" >
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">
                    @if(!$isset)
                    <form method="POST" action="/validate">
                        @csrf
                        <div class="text-center mb-5"><h4 style="color: white">Validate Certificate</h4></div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                            </div>
                            <input id="certID" type="text" name="certID" value="{{ old('email') }}" required autocomplete="certID" autofocus class="form-control @error('certID') is-invalid @enderror input_user" placeholder="{{ __('Certificate ID') }}">
                            @error('certID')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                        </div> <div class="d-flex justify-content-center mt-3 login_container">
                            <button type="submit" class="btn login_btn">{{ __('Validate') }}</button>
                        </div>
                    </form>
                        @endif
                    @if($isset)
                        <div class="card mt-1" style="width: 100%">
                            <div class="text-center mt-2"><h5>Verification Details</h5><hr></div>
                            @if($isValid)
                                <div class="text-center"><svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                                    <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                                </svg></div>
                            <div class="card-body">
                                <div class="callout callout-success">
                                    <p style="font-family: 'Source Sans Pro', sans-serif; margin-top: -9%">Certificate ID: <strong>{{$certificateID}}</strong></p>
                                    <p style="font-family: 'Source Sans Pro', sans-serif; margin-top: -9%">Name: {{$name}}</p>
                                    <p style="font-family: 'Source Sans Pro', sans-serif; margin-top: -9%">Certificate State: <span class="text-success"><strong>Valid</strong></span></p>
                                    <p style="font-family: 'Source Sans Pro', sans-serif; margin-top: -9%">Grade: {{$grade}}</p>
                                    <p style="font-family: 'Source Sans Pro', sans-serif; margin-top: -9%">Valid From: {{$startDate}}</p>
                                    <p style="font-family: 'Source Sans Pro', sans-serif; margin-top: -9%">Expiry Date: {{$validTill}}</p>
                                </div>
                            </div>
                                @endif
                                @if(!$isValid)
                                    <center class="text-center"><div class="bg-danger"><i class="fa fa-times"></i></div></center>
                                <div class="card-body">
                                    <div class="callout callout-danger">
                                        <p style="font-family: 'Source Sans Pro', sans-serif; margin-top: -9%">Certificate ID: <strong>{{$certificateID}}</strong></p>
                                        <p style="font-family: 'Source Sans Pro', sans-serif; margin-top: -9%">Certificate State: <span class="text-danger"><strong>Invalid</strong></span></p>
                                        <p style="font-family: 'Source Sans Pro', sans-serif; margin-top: -9%">Expiry Date: {{$validTill}}</p>
                                    </div>
                                </div>
                                    @endif
                        </div>
                        @endif
                </div>
                @if(!$isset)<br><br><br>@endif
                @if($isset)
                    @if(!$isValid)<br><br><br><br><br>@endif
                @endif
                <div @if(!$isset)class="mt-5" @endif>
                    <div class="text-center">NuStandards &copy; 2019-20<br><a href="https://www.nukrip.com">Nukrip Technologies Private Limited</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
