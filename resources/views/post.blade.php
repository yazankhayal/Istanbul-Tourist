@extends('layouts.app')

@section('title')
    {{$item->name()}}
@endsection

@section('body_class') site-wrapper single-blog single-blog-image @endsection
@section('header_class') main-header header-sticky header-sticky-smart header-style-01 header-float text-uppercase @endsection

@section('content')

    @include("layouts.breadcrumb")

    <div id="wrapper-content" class="wrapper-content pb-13">
        <div class="container">
            <div class="page-container">
                <div class="page-content">
                    <div class="mb-10">
                        <div class="single-blog-top pt-9">
                            <h2 class="text-center mb-3 letter-spacing-50">@yield("title")</h2>
                            <ul class="list-inline d-flex align-items-center justify-content-center flex-wrap">
                                <li class="list-inline-item mr-1">
                                    <span class="text-gray">{{$item->date('')}} -</span>
                                </li>
                                <li class="list-inline-item">
                                    {{$item->sub_name()}}
                                </li>
                            </ul>
                        </div>
                        <div class="mb-12">
                            <img src="{{$item->img()}}" style="width: 100%;" alt="@yield("title")">
                        </div>
                        <div class="single-blog-content">

                            {!! $item->summary() !!}

                            <div class="pb-11 text-center">
                                <div class="d-flex align-items-center pb-2 justify-content-center"><span
                                        class="text-dark font-weight-semibold d-inline-block mr-3">{{lang_name('Share')}}: </span>
                                    <div class="social-icon">
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a target="_blank" title="Facebook" href="{{$item->share("face")}}">
                                                    <i class="fab fa-facebook-f">
                                                    </i>
                                                    <span>Facebook</span>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a target="_blank" title="Twitter" href="{{$item->share("twitter")}}">
                                                    <i class="fab fa-twitter">
                                                    </i>
                                                    <span>Twitter</span>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a target="_blank" title="linkedin" href="{{$item->share("linkedin")}}">
                                                    <i class="fab fa-linkedin"></i>
                                                    <span>Linkedin</span>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a target="_blank" title="whatsapp" href="{{$item->share("whatsapp")}}">
                                                    <i class="fab fa-whatsapp"></i>
                                                    <span>WhatsApp</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-9">
                        <div class="mb-8 text-center">
                            <h4 class="mb-0">{{lang_name('Posts_You_Might_Like')}}</h4>
                        </div>
                        <div class="row post-style-3">
                            @if($related->count() != 0)
                                @foreach($related as $item)
                                    <div class="col-md-4 mb-4 mb-md-0" data-animate="zoomIn">
                                        <div class="card border-0">
                                            <a class="hover-scale" href="{{$item->route()}}">
                                                <img src="{{$item->img()}}" alt="{{$item->name()}}" class="fe_2_img card-img-top image">
                                            </a>
                                            <div class="card-body px-0">
                                                <div class="mb-2">
                                                    <a href="{{$item->route()}}" class="link-hover-dark-primary">{{$item->sub_name()}}</a>
                                                </div>
                                                <h5 class="card-title lh-13 letter-spacing-25">
                                                    <a href="{{$item->route()}}" class="link-hover-dark-primary text-capitalize">
                                                        {{$item->name()}}
                                                    </a>
                                                </h5>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item mr-0">
                                                        <span class="text-gray">{{$item->date('')}}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
