@extends('layouts.app')

@section('title')
    {{lang_name('Catalogue')}}
@endsection


@section('body_class') site-wrapper home-job @endsection
@section('header_class') main-header header-sticky header-sticky-smart header-style-01 text-uppercase @endsection

@section('content')

    <div class="content-wrap mb-10">
        <section class="banner" style="background-image: url('{{setting()->bunner()}}')">
            <div class="container">
                <div class="banner-content">
                    <div class="heading">
                        <h1 class="text-white lh-1 mb-3 text-uppercase">
                            <span class="d-block" data-animate="fadeInLeft">@yield("title")</span>
                        </h1>
                    </div>
                </div>
            </div>
        </section>
        <div class="job-by ">
            <div class="job-filter">
                <div class="container">
                    <ul class="nav nav-pills tab-style-02 row font-size-lg" role="tablist">
                        <li class="nav-item col-md-4">
                            <a class="nav-link active" id="category-tab" data-toggle="tab" href="#category" role="tab"
                               aria-controls="category" aria-selected="true">{{lang_name('Catalogue')}}</a>
                        </li>
                        <li class="nav-item col-md-4">
                            <a class="nav-link" id="location-tab" data-toggle="tab" href="#location" role="tab"
                               aria-controls="location" aria-selected="false">{{lang_name('Categories')}}</a>
                        </li>
                        <li class="nav-item col-md-4">
                            <a class="nav-link" id="popular-search-tab" data-toggle="tab" href="#popular-search"
                               role="tab" aria-controls="popular-search" aria-selected="false">{{lang_name('City')}}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="job-by-container bg-dark">
                <div class="container">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="category" role="tabpanel"
                             aria-labelledby="category-tab">
                            <div class="row">
                                @if(catalogue()->count() != 0)
                                    @foreach(catalogue() as $item2 )
                                        <div class="col-sm-6 col-md-3">
                                            <ul class="list-group list-group-flush list-group-borderless py-6">
                                                <li class="list-group-item bg-transparent p-0">
                                                    <a href="{{$item2->route_services()}}" class="text-white ">{{$item2->name()}}</a><span
                                                        class="d-inline-block text-primary ml-1">({{$item2->Services->count()}})</span>
                                                </li>
                                            </ul>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab">
                            <div class="row">
                                @if(category()->count() != 0)
                                    @foreach(category() as $item2 )
                                        <div class="col-sm-6 col-md-3">
                                            <ul class="list-group list-group-flush list-group-borderless py-6">
                                                <li class="list-group-item bg-transparent p-0">
                                                    <a href="{{$item2->route_services()}}" class="text-white ">{{$item2->name()}}</a><span
                                                        class="d-inline-block text-primary ml-1">({{$item2->Services->count()}})</span>
                                                </li>
                                            </ul>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="popular-search" role="tabpanel"
                             aria-labelledby="popular-search-tab">
                            <div class="row">
                                @if(city()->count() != 0)
                                    @foreach(city() as $item2 )
                                        <div class="col-sm-6 col-md-3">
                                            <ul class="list-group list-group-flush list-group-borderless py-6">
                                                <li class="list-group-item bg-transparent p-0">
                                                    <a href="{{$item2->route_services()}}" class="text-white ">{{$item2->name()}}</a><span
                                                        class="d-inline-block text-primary ml-1">({{$item2->Services->count()}})</span>
                                                </li>
                                            </ul>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
