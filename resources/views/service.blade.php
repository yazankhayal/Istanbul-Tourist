@extends('layouts.app')

@section('title')
    {{$item->name()}}
@endsection

@section('css')
    <style>
        .iframe_d iframe {
            width: 100% !important;
            height: 300px;
        }

        .fa.active {
            color: #ff5a5f;
        }
    </style>
@endsection

@section('body_class') site-wrapper explore-details explore-details-full-gallery @endsection
@section('header_class') main-header header-sticky header-sticky-smart header-style-01 bg-white text-uppercase @endsection

@section('content')

    <div id="wrapper-content" class="wrapper-content pb-0 pt-0">

        <div class="image-gallery">
            <div class="slick-slider arrow-center"
                 data-slick-options='{"slidesToShow": 1, "autoplay":true,"infinite": true,"centerMode": true,"centerPadding": "0","dots":false,"variableWidth": true, "variableHeight": true,"focusOnSelect": true,"responsive":[{"breakpoint": 576,"settings": {"slidesToShow": 1,"arrows": false,"autoplay":true}}]}'>

                @if(count(explode(",",$item->images)) != 0)
                    @php $center = 1; @endphp
                    @foreach(explode(",",$item->images) as $key => $value)
                        @if($value)
                            <div class="box {{$center == 2 ? "center" : ""}}"><img
                                    src="{{path().'upload/gallery_services/'.$value}}" alt="{{$value}} 01"></div>
                            @php $center = $center + 1; @endphp
                        @endif
                    @endforeach
                @endif

            </div>
        </div>

        <div class="page-title bg-gray-06 pt-8 pb-9">
            <div class="container">
                <ul class="breadcrumb breadcrumb-style-03 mb-6">
                    <li class="breadcrumb-item"><a href="{{route('index')}}">{{lang_name('Home_Page')}}</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{$item->Catalogue->route_services()}}">{{$item->Catalogue->name()}}</a></li>
                    <li class="breadcrumb-item">@yield("title")</li>
                </ul>
                <div class="explore-details-top d-flex flex-wrap flex-lg-nowrap">
                    <div class="store">
                        <div class="d-flex flex-wrap">
                            <h2 class="text-dark mr-3 mb-2">
                                @yield("title")
                            </h2>
                            <span class="check font-weight-semibold text-green mb-2">
                                            @if($item->verified == 1)
                                    <svg class="icon icon-check-circle"><use
                                            xlink:href="#icon-check-circle"></use></svg>
                                    {{lang_name('verified')}}
                                </span>
                            @endif
                        </div>
                        <ul class="list-inline store-meta d-flex flex-wrap align-items-center">
                            <li class="list-inline-item"><span
                                    class="badge badge-success d-inline-block mr-1">{{$item->Category->name()}}</span>
                            </li>
                            <li class="list-inline-item separate"></li>
                            <li class="list-inline-item">
                                <a href="{{$item->route()}}"
                                   class=" text-link text-decoration-none d-flex align-items-center">
                                <span class="d-inline-block mr-2 font-size-md">
                                </span>
                                    <span>{{$item->Catalogue->name()}}</span>
                                </a>
                            </li>
                            <li class="list-inline-item separate"></li>
                            <li class="list-inline-item">
                                <span class="mr-1"><i class="fal fa-clock"></i></span>
                                <span>{{lang_name('Posted')}} {{$item->date('')}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="page-container">
                <div class="row">
                    @if(adv_block() != null)
                        @if(adv_block()->adv_blog_view_1 != null)
                            <div class="campaign">
                                {!!  adv_block()->adv_blog_view_1 !!}
                            </div>
                        @endif
                    @endif
                    <div class="page-content col-xl-8 mb-8 mb-xl-0">
                        <div class="explore-details-container">
                            <div class="mb-9">
                                <h3 class="font-size-lg text-uppercase font-weight-semibold border-bottom pb-1 pt-2 mb-6">
                                    {{lang_name('Description')}}
                                </h3>
                                {!! $item->summary() !!}
                                <div class="iframe_d">
                                    {!! $item->iframe !!}
                                </div>
                            </div>
                            <div class="block-review">
                                <h3 class="font-size-lg text-uppercase border-bottom pb-1 mb-6">
                                    {{lang_name('Reviews_Ratings')}}
                                </h3>
                                <div id="tag_container">
                                    @include("data.comment")
                                </div>
                            </div>

                            @if(adv_block() != null)
                                @if(adv_block()->adv_blog_view_2 != null)
                                    <div class="campaign">
                                        {!!  adv_block()->adv_blog_view_2 !!}
                                    </div>
                                @endif
                            @endif
                            <div class="block-form-review bg-gray-06 px-5 pb-6">
                                <h4 class="font-size-md pb-1 border-bottom pt-4 mb-4">
                                    {{lang_name('Rate_Us_Write_A_Review')}}
                                </h4>
                                <form method="post" data-name="rating_services" class="ajaxForm rating_services"
                                      action="{{route('rating_services')}}">
                                    {{csrf_field()}}
                                    <input type="hidden" id="services_id" name="services_id" value="{{$item->id}}"/>
                                    <input type="hidden" id="star" name="star" value="6"/>
                                    <div class="row mb-4 flex-md-nowrap align-items-center">
                                        <div
                                            class="form-group d-flex form-rate col-md-6 align-items-center mb-4 mb-md-0">
                                            <span class="d-inline-block mr-2">{{lang_name('Select_your_rating')}}</span>
                                            <div class="rate-input d-flex">
                                                <i data-id="5" title="5" class="s_5 fa fa-star"></i>
                                                <i data-id="4" title="4" class="s_4 fa fa-star"></i>
                                                <i data-id="3" title="3" class="s_3 fa fa-star"></i>
                                                <i data-id="2" title="2" class="s_2 fa fa-star"></i>
                                                <i data-id="1" title="1" class="s_1 fa fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <input class="form-control" placeholder="{{lang_name('Subject')}}" id="name"
                                               name="name">
                                    </div>
                                    <div class="form-group mb-4">
                                        <textarea class="form-control"
                                                  id="text"
                                                  name="text"
                                                  placeholder="{{lang_name('Comments')}}"></textarea>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary font-size-md btn-lg lh-base">
                                            {{lang_name('Sign_Up_Submit_Review')}}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar col-xl-4">


                        @if(adv_block() != null)
                            @if(adv_block()->adv_blog_1 != null)
                                <div class="campaign">
                                    {!!  adv_block()->adv_blog_1 !!}
                                </div>
                            @endif
                        @endif

                        @if($item->address != null)
                            <div class="card p-4 widget border-0 infomation pt-0 bg-gray-06">
                                <div class="card-body px-0 py-2">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item bg-transparent d-flex text-dark px-0">
                                            <span class="item-icon mr-3"><i class="fal fa-map-marker-alt"></i></span>
                                            <span class="card-text">{{$item->address}}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endif


                        <div class="card p-4 widget border-0 gallery bg-gray-06 rounded-0 mb-6">
                            <div
                                class="card-title d-flex mb-0 font-size-md font-weight-semibold text-dark text-uppercase border-bottom pb-2 lh-1">
                                <span class="text-secondary mr-3">
                                <i class=" fa fa-image"></i>
                                </span>
                                <span>{{lang_name('photo_gallery')}}</span>
                            </div>
                            <div class="card-body px-0 pt-6 pb-3">
                                <div class="photo-gallery d-flex flex-wrap justify-content-between">
                                    @if(count(explode(",",$item->images)) != 0)
                                        @foreach(explode(",",$item->images) as $key => $value)
                                            @if($value)
                                                <a href="{{path().'upload/gallery_services/'.$value}}"
                                                   class="photo-item" data-gtf-mfp="true"
                                                   data-gallery-id="01">
                                                    <img src="{{path().'upload/gallery_services/'.$value}}"
                                                         alt="{{$value}} 01">
                                                </a>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card p-4 widget border-0 relate-listing bg-gray-06 rounded-0">
                            <div
                                class="card-title d-flex mb-0 font-size-md font-weight-semibold text-dark text-uppercase border-bottom pb-2 lh-1">
                                <span>{{lang_name('related_listing')}}</span>
                            </div>
                            <div class="card-body px-0 pb-0 pt-3">
                                <ul class="list-group list-group-flush">
                                    @if($related->count() != 0)
                                        @foreach($related as $i)
                                            <li class="list-group-item bg-transparent text-dark px-0 py-3 h-100">
                                                <div class="store media align-items-stretch">
                                                    <div class="store-image">
                                                        <a href="{{$i->route()}}">
                                                            <img src="{{$i->img()}}" alt="{{$i->name()}}">
                                                        </a>
                                                    </div>
                                                    <div class="media-body pl-0 pl-sm-3 pt-4 pt-sm-0 pr-0">
                                                        <a href="{{$i->route()}}"
                                                           class="font-size-md font-weight-semibold text-dark d-inline-block mb-1 lh-11"><span
                                                                class="letter-spacing-25">{{$i->name()}}</span>
                                                        </a>
                                                        <div class="d-flex align-items-center mb-1">
                                                            <div class="pr-3"><span
                                                                    class="badge badge-warning d-inline-block mr-1">{{$item->Catalogue->name()}}</span>
                                                            </div>
                                                        </div>
                                                        <div>
                                                                <span class="d-inline-block mr-1"><i
                                                                        class="fal fa-map-marker-alt">
                                                                </i>
                                                                </span>
                                                            <a href="{{$i->route()}}"
                                                               class="text-secondary text-decoration-none address">
                                                                {{$i->address}}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="list-group-item bg-transparent text-dark px-0 py-3 h-100">
                                            {{lang_name('Empty')}}
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                        @if(adv_block() != null)
                            @if(adv_block()->adv_blog_2 != null)
                                <div class="campaign">
                                    {!!  adv_block()->adv_blog_2 !!}
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section("js")
    <script>
        $(window).on('hashchange', function () {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else {
                    getData(page);
                }
            }
        });
        $(document).ready(function () {

            //Render_Data();

            $(".rate-input i").click(function () {
                var id = $(this).data("id");
                $("#star").val(id);
                $(".rate-input i").removeClass("active");
                for (var i = 1; i <= id; i++) {
                    $(".s_" + i).addClass("active");
                }
            });

            $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();

                $('li').removeClass('active');
                $(this).parent('li').addClass('active');

                var myurl = $(this).attr('href');
                var page = $(this).attr('href').split('page=')[1];

                getData(page);
            });

        });

        function getData(page) {
            $.ajax(
                {
                    url: '?page=' + page,
                    type: "get",
                    datatype: "html"
                }).done(function (data) {
                $("#tag_container").empty().html(data);
                location.hash = page;
            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });
        }
    </script>
@endsection
