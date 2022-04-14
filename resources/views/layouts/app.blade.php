<!doctype html>
<html lang="{{app()->getLocale()}}" dir="{{app()->getLocale() == "ar" ? "rtl" : "ltr"}}">
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<head>
    @includeIf('layouts.css')
    @yield('css')
    @if(scripts() != null)
        {!! scripts()->css !!}
    @endif
</head>
<body>

@if(save_lang() != null)
<div id="site-wrapper" class="@yield('body_class')">

    <header id="header"
            class=" @yield('header_class')">
        <div class="header-wrapper sticky-area">
            <div class="container container-1720">
                <nav class="navbar navbar-expand-xl">
                    <div class="header-mobile d-flex d-xl-none flex-fill justify-content-between align-items-center">
                        <div class="navbar-toggler toggle-icon" data-toggle="collapse" data-target="#navbar-main-menu">
                            <span></span>
                        </div>
                        <a class="navbar-brand navbar-brand-mobile" href="{{route('index')}}">
                            <img src="{{setting()->avatar()}}" alt="{{setting()->name()}}">
                        </a>
                        <a class="mobile-button-search" href="#search-popup" data-gtf-mfp="true"
                           data-mfp-options='{"type":"inline","mainClass":"mfp-move-from-top mfp-align-top search-popup-bg","closeOnBgClick":false,"showCloseBtn":false}'><i
                                class="far fa-search"></i></a>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-main-menu">
                        <a class="navbar-brand d-none d-xl-block mr-auto" href="{{route('index')}}">
                            <img src="{{setting()->avatar()}}" alt="{{setting()->name()}}">
                        </a>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('index')}}">{{lang_name('Home_Page')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('catalogue')}}">{{lang_name('Catalogue')}}
                                </a>
                            </li>
                            @if(pages_header()->count() != 0)
                                @foreach(pages_header() as $item)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{$item->route()}}">
                                            {{$item->name()}}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('blog')}}">{{lang_name('Blog')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <img src="{{path().$select_lan->avatar}}" alt="{{$select_lan->name}}" class="img_flag">
                                    {{$select_lan->name}}
                                    <span class="caret"><i class="fas fa-angle-down"></i></span></a>
                                <ul class="sub-menu x-animated x-fadeInUp">
                                    @if($langauges->where('dir','!=',app()->getLocale())->count() > 0)
                                        @foreach($langauges->where('dir','!=',app()->getLocale()) as $lang222)
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                   href="{{route('change_language',['lang'=>$lang222->dir])}}">
                                                    <img src="{{path().$lang222->avatar}}" alt="{{$lang222->name}}" class="img_flag">
                                                    {{$lang222->name}}
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </li>
                        </ul>
                        <div class="header-customize justify-content-end align-items-center d-none d-xl-flex">
                            <div class="header-customize-item">
                                @if($user != null)
                                    <a href="{{route('home')}}" class="link">
                                        <i class="fa fa-user"></i>
                                        {{$user->name}}
                                    </a>
                                @else
                                    <a href="{{route('login')}}" class="link">
                                        <i class="fa fa-user"></i>
                                        {{lang_name('Log_In')}}
                                    </a>
                                @endif
                            </div>
                            <div class="header-customize-item button">
                                <a href="{{route('services')}}" class="btn btn-primary btn-icon-right">
                                    {{lang_name('Services')}}
                                    <i class="far fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>

@yield("content")

@include("layouts.footer")

@endif

<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{lang_name('Select_langauge')}}</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    @if($langauges->count() > 0)
                        @foreach($langauges as $lang222)
                            <a href="{{route('change_language',['lang'=>$lang222->dir])}}">
                                <span class="btn btn-primary"style="margin-top: 7px;" >
                                    <img src="{{path().$lang222->avatar}}" alt="{{$lang222->name}}" class="img_flag">
                                    {{$lang222->name}}
                                </span>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPTS -->
@includeIf('layouts.js')
<script>
    var geturlphoto = function () {
        return "{{$setting->public}}";
    };
    var save_lang = "{{save_lang()}}";
    $(document).ready(function () {

        if(save_lang == null || save_lang == ""|| save_lang.length == 0){
            $("#staticBackdrop").modal('show');
        }

        $(document).ajaxStart(function () {
            NProgress.start();
        });
        $(document).ajaxStop(function () {
            NProgress.done();
        });
        $(document).ajaxError(function () {
            NProgress.done();
        });

    });
</script>
@yield('js')
@if(scripts() != null)
    {!! scripts()->js !!}
@endif
@if(scripts() != null)
    {!! scripts()->custom !!}
@endif

</body>

</html>
