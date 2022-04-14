@extends('layouts.app')

@section('title')
    {{$user->name}}
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
                            <form class="mt-4 form-horizontal" enctype="multipart/form-data" method="POST"
                                  action="{{ route('profile') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="text"
                                           class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           value="{{$user->name}}"
                                           id="name" name="name" placeholder="{{lang_name('Full_Name')}}">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text"
                                           class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           id="email" name="email"
                                           value="{{$user->email}}"
                                           placeholder="{{lang_name('Email')}}">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input type="password"
                                           class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           id="password"
                                           name="password"
                                           placeholder="{{lang_name('Password')}}">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input type="password"
                                           class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                           id="password_confirmation"
                                           name="password_confirmation"
                                           placeholder="{{lang_name('Password_Confirm')}}">
                                </div>
                                <div class="form-group mb-3">
                                    @if($user->type_login == null)
                                        <input type="file"
                                               class="form-control {{ $errors->has('file') ? ' is-invalid' : '' }}"
                                               id="avatar"
                                               name="avatar">
                                    @endif
                                    <hr>
                                    @if($user->type_login == null)
                                        <img style="height: 100px;"
                                             src="{{path().$user->avatar}}"
                                             alt="{{$user->name}}"
                                             class="img-thumbnail">
                                    @else
                                            <img style="height: 100px;"
                                                 src="{{$user->avatar}}"
                                                 alt="{{$user->name}}"
                                                 class="img-thumbnail">
                                    @endif
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit"
                                            class="btn btn-primary btn-block">{{lang_name('Edit')}}</button>
                                </div>
                            </form>
                            <div class="form-group mb-0">
                                <hr>
                                <a class="btn btn-success btn-block" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
										  document.getElementById('logout-form2').submit();">
                                    {{$lang->LogOff}}
                                </a>
                                <form id="logout-form2" action="{{ route('logout') }}"
                                      method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection

