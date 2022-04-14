@extends('layouts.app')

@section('title')
    {{lang_name('Home_Page')}}
@endsection

@section('body_class') site-wrapper home-main @endsection
@section('header_class') main-header header-sticky header-sticky-smart header-style-01 header-float text-uppercase @endsection

@section('content')

    <section id="section-01" class="home-main-intro"
             style="background-image: url('{{$about != null ? $about->img1() : null}}')">
        <div class="home-main-intro-container">
            <div class="container">
                <div class="heading mb-9">
                    @if($about)
                        {!! $about->summary() !!}
                    @endif
                </div>
                <div class="form-search form-search-style-02 pb-9" data-animate="fadeInDown">
                    <form method="get" action="{{route('services')}}">
                        <div class="row align-items-end no-gutters">
                            <div
                                class="col-xl-6 mb-4 mb-xl-0 py-3 px-4 bg-white border-right-0 border-right-xl position-relative rounded form-search-item">
                                <label for="key-word"
                                       class="font-size-md font-weight-semibold text-dark mb-0 lh-1">{{lang_name('Categories')}}</label>
                                <div class="input-group dropdown show">
                                    <select class="" id="category_id" name="category_id">
                                        <option value="">{{lang_name('Categories')}}</option>
                                        @if(category()->count() != 0)
                                            @foreach(category() as $item)
                                                <option value="{{$item->id}}">{{$item->name()}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div
                                class="col-xl-4 mb-4 mb-xl-0 py-3 px-4 bg-white position-relative rounded form-search-item">
                                <label for="key-word"
                                       class="font-size-md font-weight-semibold text-dark mb-0 lh-1">{{lang_name('Catalogue')}}</label>
                                <div class="input-group dropdown show">
                                    <select class="" id="catalogue_id" name="catalogue_id">
                                        <option value="">{{lang_name('Catalogue')}}</option>
                                        @if(catalogue()->count() != 0)
                                            @foreach(catalogue() as $item)
                                                <option value="{{$item->id}}">{{$item->name()}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-2 button">
                                <button type="submit" class="btn btn-primary btn-lg btn-icon-left btn-block"><i
                                        class="fal fa-search"></i>
                                    {{lang_name('Search')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="font-size-lg mb-4">
                    {{lang_name('Or_browse_the_highlights')}}
                </div>
                <div class="list-inline pb-8 flex-wrap my-n2">

                    @if(category()->count() != 0)
                        @foreach(category() as $item)
                            <div class="list-inline-item py-2">
                                <a href="{{$item->route_services()}}"
                                   class="card border-0 icon-box-style-01 link-hover-dark-white">
                                    <div class="card-body p-0">
                                        <img src="{{$item->img()}}" alt="{{$item->name()}}">
                                        <span
                                            class="card-text font-size-md font-weight-semibold mt-2 d-block">{{$item->name()}}</span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
            <div class="home-main-how-it-work bg-white pt-11">
                <div class="container">
                    <h2 class="mb-8">
                        <span>{{lang_name('See')}}</span>
                        <span class="font-weight-light">{{lang_name('How_It_Works')}}</span>
                    </h2>
                    <div class="row no-gutters pb-11">
                        @if($address->count() != 0)
                            @foreach($address as $item)
                                <div class="col-lg-4 mb-4 mb-lg-0 px-0 px-lg-4">
                                    <div class="media icon-box-style-02" data-animate="fadeInDown">
                                        {!! $item->summary() !!}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="border-bottom"></div>
                </div>
            </div>
        </div>
    </section>


    <section id="section-02" class="pb-8 feature-destination pt-85">
        <div class="container">
            <div class="mb-8">
                <h2 class="mb-0">
                    <span>{{lang_name('Featured')}} </span>
                    <span class="font-weight-light">{{lang_name('Destinations')}}</span>
                </h2>
            </div>
            <div class="slick-slider arrow-center"
                 data-slick-options='{"slidesToShow": 3, "autoplay":false,"dots":false,"responsive":[{"breakpoint": 992,"settings": {"slidesToShow": 3,"arrows":false,"dots":true,"autoplay":true}},{"breakpoint": 768,"settings": {"slidesToShow": 2,"arrows":false,"dots":true,"autoplay":true}},{"breakpoint": 400,"settings": {"slidesToShow": 1,"arrows":false,"dots":true,"autoplay":true}}]}'>

                @if($home_1->count() != 0)
                    @foreach($home_1 as $item)
                        <div class="box" data-animate="fadeInUp">
                            <div class="store card border-0 rounded-0">
                                <div class="position-relative store-image">
                                    <a href="{{$item->route()}}">
                                        <img style="height: 250px;" src="{{$item->img()}}" alt="{{$item->name()}}"
                                             class="card-img-top  fe_2_img rounded-0">
                                    </a>
                                    <div class="image-content position-absolute d-flex align-items-center">
                                        <div class="content-left">
                                            @if($item->verified == 1)
                                                <div class="badge badge-success">
                                                    {{lang_name('verified')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body px-0 pb-0 pt-3">
                                    <a href="{{$item->route()}}"
                                       class="card-title h5 text-dark d-inline-block mb-2"><span
                                            class="letter-spacing-25">{{$item->name()}}</span></a>
                                    <ul class="list-inline store-meta mb-4 font-size-sm d-flex align-items-center flex-wrap">
                                        <li class="list-inline-item"><span
                                                class="badge badge-success d-inline-block mr-1">
                                                    {{$item->Category->name()}}
                                                </span>
                                        </li>
                                        <li class="list-inline-item separate"></li>
                                        <li class="list-inline-item"><span class="mr-1">{{lang_name('City')}}</span>
                                            <span
                                                class="text-danger font-weight-semibold">{{$item->City->name()}}</span>
                                        </li>
                                        <li class="list-inline-item separate"></li>
                                        <li class="list-inline-item">
                                            <a href="{{$item->Catalogue->route_services()}}"
                                               class="link-hover-secondary-primary">
                                                <span>{{$item->Catalogue->name()}}</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="media">
                                        <div class="media-body lh-14 font-size-sm">
                                            {{$item->sub_name()}}
                                        </div>
                                    </div>
                                </div>
                                <ul class="list-inline card-footer rounded-0 border-top pt-3 mt-5 bg-transparent px-0 store-meta d-flex align-items-center">
                                    @if($item->address != null)
                                        <li class="list-inline-item">
<span class="d-inline-block mr-1">
<i class="fal fa-map-marker-alt">
</i>
</span>
                                            <a href="{{$item->route()}}"
                                               class="text-secondary text-decoration-none link-hover-secondary-blue">
                                                {{$item->address}}</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>


    <section id="section-03" class="pb-8 our-directory">
        <div class="container">
            <div class="mb-7">
                <h2 class="mb-0">
                    <span class="font-weight-semibold">{{lang_name('Our')}} </span>
                    <span class="font-weight-light">{{lang_name('Directory')}}</span>
                </h2>
            </div>
        </div>
        <div class="container container-1720">
            <div class="tab-content">
                <div class="slick-slider arrow-top full-slide custom-nav equal-height"
                     data-slick-options='{"slidesToShow": 5,"autoplay":false,"dots":false,"arrows":false,"responsive":[{"breakpoint": 2000,"settings": {"slidesToShow": 4}},{"breakpoint": 1500,"settings": {"slidesToShow": 3}},{"breakpoint": 1000,"settings": {"slidesToShow": 2}},{"breakpoint": 770,"settings": {"slidesToShow": 1}}]}'>

                    @if($home_2->count() != 0)
                        @foreach($home_2 as $item)
                            <div class="box" data-animate="fadeInUp">
                                <div class="store card border-0 rounded-0">
                                    <div class="position-relative store-image">
                                        <a href="{{$item->route()}}">
                                            <img style="height: 250px;" src="{{$item->img()}}" alt="{{$item->name()}}"
                                                 class="card-img-top fe_2_img rounded-0">
                                        </a>
                                        <div class="image-content position-absolute d-flex align-items-center">
                                            <div class="content-left">
                                                @if($item->verified == 1)
                                                    <div class="badge badge-success">
                                                        {{lang_name('verified')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body px-0 pb-0 pt-3">
                                        <a href="{{$item->route()}}"
                                           class="card-title h5 text-dark d-inline-block mb-2"><span
                                                class="letter-spacing-25">{{$item->name()}}</span></a>
                                        <ul class="list-inline store-meta mb-4 font-size-sm d-flex align-items-center flex-wrap">
                                            <li class="list-inline-item"><span
                                                    class="badge badge-success d-inline-block mr-1">
                                                    {{$item->Category->name()}}
                                                </span>
                                            </li>
                                            <li class="list-inline-item separate"></li>
                                            <li class="list-inline-item"><span class="mr-1">{{lang_name('City')}}</span>
                                                <span
                                                    class="text-danger font-weight-semibold">{{$item->City->name()}}</span>
                                            </li>
                                            <li class="list-inline-item separate"></li>
                                            <li class="list-inline-item">
                                                <a href="{{$item->Catalogue->route_services()}}"
                                                   class="link-hover-secondary-primary">
                                                    <span>{{$item->Catalogue->name()}}</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="media">
                                            <div class="media-body lh-14 font-size-sm">
                                                {{$item->sub_name()}}
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline card-footer rounded-0 border-top pt-3 mt-5 bg-transparent px-0 store-meta d-flex align-items-center">
                                        @if($item->address != null)
                                        <li class="list-inline-item">
<span class="d-inline-block mr-1">
<i class="fal fa-map-marker-alt">
</i>
</span>
                                                <a href="{{$item->route()}}"
                                                   class="text-secondary text-decoration-none link-hover-secondary-blue">
                                                    {{$item->address}}</a>
                                        </li>
                                    </ul>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </section>


    <section class="home-main-testimonial pt-12 pb-13" id="section-04">
        <div class="container">
            <h2 class="mb-8">
                <span class="font-weight-semibold">{{lang_name('Clients')}} </span>
                <span class="font-weight-light">{{lang_name('Review')}}</span>
            </h2>
            <div class="container">
                <div class="row">
                    <div class="col col-md-12">
                        <div class="slick-slider testimonials-slider arrow-top"
                             data-slick-options='{"slidesToShow": 2,"autoplay":false,"dots":false,"responsive":[{"breakpoint": 992,"settings": {"slidesToShow": 1,"arrows":false}}]}'>

                            @if($test->count() != 0)
                                @foreach($test as $item)
                                    <div class="box">
                                        <div class="card testimonial h-100 border-0 bg-transparent">
                                            <a href="#" class="author-image">
                                                <img style="height: 90px;" src="{{$item->img()}}" alt="{{$item->name()}}"
                                                     class="rounded-circle">
                                            </a>
                                            <div class="card-body bg-white">
                                                <div class="testimonial-icon text-right">
                                                    <svg class="icon icon-quote">
                                                        <use xlink:href="#icon-quote"></use>
                                                    </svg>
                                                </div>
                                                <ul class="list-inline mb-4 d-flex align-items-end flex-wrap">
                                                    <li class="list-inline-item">
                                                        <a href="#"
                                                           class="font-size-lg text-dark font-weight-semibold d-inline-block">{{$item->name()}}
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                    <span
                                                        class="h5 font-weight-light mb-0 d-inline-block ml-1 text-gray">/</span>
                                                    </li>
                                                    <li>
<span class="text-gray">
{{$item->bio()}}
</span>
                                                    </li>
                                                </ul>
                                                <div class="card-text text-gray pr-4">{{$item->summary()}}
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
        </div>
    </section>


    <section id="section-05" class="pt-11 pb-11">
        <div class="container">
            <div class="d-flex align-items-center mb-7 flex-wrap flex-sm-nowrap">
                <h2 class="mb-3 mb-sm-0">
                    <span class="font-weight-semibold">{{lang_name('Some')}}</span>
                    <span class="font-weight-light">{{lang_name('Tips_Articles')}}</span>
                </h2>
                <a href="{{route('blog')}}" class="link-hover-dark-primary ml-0 ml-sm-auto w-100 w-sm-auto">
                    <span class="font-size-md d-inline-block mr-1">{{lang_name('All_articles')}}</span>
                    <i class="fal fa-chevron-right"></i>
                </a>
            </div>
            <div class="row">
                @if($blog->count() != 0)
                    @foreach($blog as $item)
                        <div class="col-md-4 mb-4" data-animate="zoomIn">
                            <div class="card border-0">
                                <a class="hover-scale" href="{{$item->route()}}">
                                    <img style="height: 300px;" src="{{$item->img()}}" alt="{{$item->name()}}"
                                         class="blog_img card-img-top image">
                                </a>
                                <div class="card-body px-0">
                                    <div class="mb-2">
                                        <a href="{{$item->route()}}"
                                           class="link-hover-dark-primary">{{$item->sub_name()}}</a>
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
    </section>


@endsection
