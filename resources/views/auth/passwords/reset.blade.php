@extends('layouts.app')

@section('title')
    {{lang_name('Reset')}}
@endsection

@section('body_class') site-wrapper @endsection
@section('header_class') main-header header-sticky header-sticky-smart header-style-01 text-uppercase @endsection

@section('content')


    @include("layouts.breadcrumb")

    <div id="section-01" class="pb-8">
        <div class="container">

            <div class="row  d-flex justify-content-center" style="margin: 40px auto;">
                <div class="col-lg-6">
                    <div class="card p-4 widget infomation border-0 bg-gray-06 rounded-0 mb-6">
                        <div
                            class="card-title d-flex mb-0 font-size-md font-weight-semibold text-dark text-uppercase border-bottom pb-2 lh-1">
                            <span class="text-secondary mr-3"><i class="fas fa-info-circle"></i></span>
                            <span>@yield("title")</span>
                        </div>
                        <div class="card-body px-0 pt-3 pb-0">
                            @includeIf("layouts.msg")

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif


                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">
                                        {{lang_name('Email')}}
                                    </label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">
                                        {{lang_name('Password')}}
                                    </label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                        {{lang_name('Password_Confirm')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            @yield("title")
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection

