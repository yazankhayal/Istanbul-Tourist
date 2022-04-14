@extends('layouts.app')

@section('title')
    {{lang_name('Log_In')}}
@endsection

@section('body_class') site-wrapper @endsection
@section('header_class') main-header header-sticky header-sticky-smart header-style-01 text-uppercase @endsection

@section('css')
    <style type="text/css">
        /* add appropriate colors to fb, twitter and google buttons */
        .fb {
            background-color: #3B5998;
            color: white;
        }

        .google {
            background-color: #dd4b39;
            color: white;
        }

        /* style inputs and link buttons */
        .col_x {
            text-align: center;
            display: block;
            margin: 20px auto;
        }

        .col_x .btn {
            margin: 10px 5px;
            text-align: center;
            padding: 10px 15px;
            text-decoration: none;
        }
    </style>
@endsection


@section('content')


    @include("layouts.breadcrumb")

    <div id="section-01" class="pb-8">
        <div class="container" >

            <div class="row  d-flex justify-content-center" style="margin: 40px auto;">
                <div class="col-lg-6">
                    <div class="card p-4 widget infomation border-0 bg-gray-06 rounded-0 mb-6">
                        <div class="card-title d-flex mb-0 font-size-md font-weight-semibold text-dark text-uppercase border-bottom pb-2 lh-1">
                            <span class="text-secondary mr-3"><i class="fas fa-info-circle"></i></span>
                            <span>@yield("title")</span>
                        </div>
                        <div class="card-body px-0 pt-3 pb-0">
                            @includeIf("layouts.msg")
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mt-4 form-horizontal" >
                                    <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           type="text" id="email" value="{{ old('email') }}" name="email"
                                           placeholder="{{lang_name('Email')}}" >
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           type="password" name="password" placeholder="{{lang_name('Password')}}" >
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-primary btn-block">@yield("title")</button>
                                    <hr>
                                    <a class="btn btn-success btn-block" href="{{ route('register') }}">
                                        {{$lang->Register}}
                                    </a>
                                    <hr>
                                    <div class="col_x">
                                        <a href="{{ route('facebook') }}" class="fb btn">
                                            <i class="fab fa-facebook fa-fw"></i>
                                            {{lang_name('Login_with_Facebook')}}
                                        </a>
                                        <a href="{{ route('google') }}" class="google btn"><i class="fab fa-google fa-fw">
                                            </i>
                                            {{lang_name('Login_with_Google')}}
                                        </a>
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

