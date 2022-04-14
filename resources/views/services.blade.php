@extends('layouts.app')

@section('title')
    {{lang_name('Services')}}
@endsection

@section('body_class') site-wrapper explore-sidebar explore-sidebar-list @endsection
@section('header_class') main-header header-sticky header-sticky-smart header-style-01 header-float bg-white text-uppercase @endsection

@section('content')


    <div id="wrapper-content" class="wrapper-content bg-gray-04 pb-0">
        <div class="container">
            <ul class="breadcrumb breadcrumb-style-02 py-7">
                <li class="breadcrumb-item"><a href="{{route('index')}}">{{lang_name('Home_Page')}}</a></li>
                <li class="breadcrumb-item">@yield("title")</li>
            </ul>
            <div class="page-container row">
                <div class="sidebar col-12 col-lg-4 order-1 order-lg-0">

                    <div class="card search bg-white mb-6 border-0 rounded-0 px-6">
                        <div class="card-header bg-transparent border-0 pt-4 pb-0 px-0">
                            <h5 class="card-title mb-0">{{lang_name('Search_Now')}}</h5>
                        </div>
                        <div class="card-body px-0 pb-42">
                            <form method="get" action="{{route('services')}}">
                                <div class="form-search form-search-style-03">
                                    <div class="form-group">
                                        <div class="input-group d-flex align-items-center">
                                            <label for="what"
                                                   class="input-group-prepend text-dark font-weight-semibold">{{lang_name('Keywords')}}</label>
                                            <input type="text" class="form-control bg-transparent" id="q"
                                                   name="q"
                                                   placeholder="{{lang_name('Keywords')}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group d-flex align-items-center">
                                            <label for="where"
                                                   class="input-group-prepend text-dark font-weight-semibold">{{lang_name('Address')}}</label>
                                            <input type="text" class="form-control bg-transparent" id="Address"
                                                   name="address"
                                                   placeholder="{{lang_name('Address')}}">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block btn-icon-left font-size-md">
                                        <i class="fal fa-search"></i>
                                        {{lang_name('Search')}}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if(adv_block() != null)
                        @if(adv_block()->adv_blog_1 != null)
                            <div class="campaign">
                                {!!  adv_block()->adv_blog_1 !!}
                            </div>
                        @endif
                    @endif
                    <div class="card widget-filter bg-white mb-6 border-0 rounded-0 px-6">
                        <div class="card-header bg-transparent border-0 pt-4 pb-0 px-0">
                            <h5 class="card-title mb-0">{{lang_name('Filter')}}</h5>
                        </div>
                        <div class="card-body px-0">
                            <div class="form-filter">
                                <form method="get" action="{{route('services')}}">
                                    <div class="form-group category">
                                        <div class="select-custom">
                                            <select class="form-control" id="category_id" name="category_id">
                                                <option value="">{{lang_name('Categories')}}</option>
                                                @if(category()->count() != 0)
                                                    @foreach(category() as $item)
                                                        <option value="{{$item->id}}">{{$item->name()}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group category">
                                        <div class="select-custom">
                                            <select class="form-control" id="city_id" name="city_id">
                                                <option value="">{{lang_name('City')}}</option>
                                                @if(city()->count() != 0)
                                                    @foreach(city() as $item)
                                                        <option value="{{$item->id}}">{{$item->name()}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group category">
                                        <div class="select-custom">
                                            <select class="form-control" id="catalogue_id" name="catalogue_id">
                                                <option value="">{{lang_name('Catalogue')}}</option>
                                                @if(catalogue()->count() != 0)
                                                    @foreach(catalogue() as $item)
                                                        <option value="{{$item->id}}">{{$item->name()}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block btn-icon-left font-size-md">
                                        <i class="fal fa-search"></i>
                                        {{lang_name('Search')}}
                                    </button>
                                </form>
                            </div>
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
                <div class="page-content col-12 col-lg-8">
                    <div class="explore-filter d-lg-flex align-items-center d-block">
                        <div
                            class="text-dark font-weight-semibold font-size-md mb-4 mb-lg-0">{{$items->total()}} {{lang_name('Results_found')}}</div>
                    </div>
                    @include("data.services")
                </div>
            </div>
        </div>
        <div class="recent-view bg-white pt-9 pb-0 pb-10">
            <div class="container">
                <div class="mb-6">
                    <h5 class="mb-0">
                        {{lang_name('Recently_Viewed')}}
                    </h5>
                </div>
                <div class="row">
                    @if($items->count() != 0)
                        @foreach($items as $item)
                            <div class="col-lg-4 mb-4 mb-lg-0">
                                <div class="store media align-items-stretch bg-white">
                                    <div class="store-image position-relative">
                                        <a href="{{$item->route()}}">
                                            <img src="{{$item->img()}}" alt="{{$item->name()}}"
                                                 class="">
                                        </a>
                                    </div>
                                    <div class="media-body pl-0 pl-sm-3 pt-4 pt-sm-0">
                                        <a href="{{$item->route()}}"
                                           class="font-size-md font-weight-semibold text-dark d-inline-block mb-2 lh-11"><span
                                                class="letter-spacing-25">{{$item->name()}}</span> </a>
                                        <ul class="list-inline store-meta mb-2 lh-1 font-size-sm d-flex align-items-center flex-wrap">
                                            <li class="list-inline-item"><span
                                                    class="badge badge-warning d-inline-block mr-1">{{$item->Category->name()}}</span>
                                            </li>
                                            <li class="list-inline-item separate"></li>
                                            <li class="list-inline-item"><span class="mr-1">{{lang_name('City')}}</span><span
                                                    class="text-danger font-weight-semibold">{{$item->City->name()}}</span>
                                            </li>
                                        </ul>
                                        <div>
<span class="d-inline-block mr-1"><i class="fal fa-map-marker-alt">
</i>
</span>
                                            <a href="{{$item->route()}}"
                                               class="text-secondary text-decoration-none address">
                                                {{$item->address}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
