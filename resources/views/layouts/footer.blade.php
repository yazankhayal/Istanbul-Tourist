<footer class="main-footer main-footer-style-01 bg-pattern-01 pt-12 pb-8">
    <div class="footer-second">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-4 mb-6 mb-lg-0">
                    <!-- <div class="mb-8"><img src="{{setting()->avatar1()}}" alt="{{setting()->name()}}"></div>-->
                    <div class="mb-7">
                        <div class="font-size-md font-weight-semibold text-dark mb-4">{{setting()->name()}}</div>
                        <p class="mb-0">
                            {{hp_contact()->address}}<br>
                            {{hp_contact()->phone}}<br>
                            {{hp_contact()->email}}</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg mb-6 mb-lg-0">
                    <div class="font-size-md font-weight-semibold text-dark mb-4">
                        {{lang_name('Footer_one')}}
                    </div>
                    <ul class="list-group list-group-flush list-group-borderless">
                        <li class="list-group-item px-0 lh-1625 bg-transparent py-1">
                            <a class="link-hover-secondary-primary" href="{{route('index')}}">{{lang_name('Home_Page')}}
                            </a>
                        </li>
                        <li class="list-group-item px-0 lh-1625 bg-transparent py-1">
                            <a class="link-hover-secondary-primary" href="{{route('catalogue')}}">{{lang_name('Catalogue')}}
                            </a>
                        </li>
                        @if(pages_footer()->count() != 0)
                            @foreach(pages_footer() as $item)
                                <li class="list-group-item px-0 lh-1625 bg-transparent py-1">
                                    <a href="{{$item->route()}}" class="link-hover-secondary-primary">
                                        {{$item->name()}}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-md-6 col-lg mb-6 mb-lg-0">
                    <div class="font-size-md font-weight-semibold text-dark mb-4">
                        {{lang_name('Footer_two')}}
                    </div>
                    <ul class="list-group list-group-flush list-group-borderless">
                        <li class="list-group-item px-0 lh-1625 bg-transparent py-1">
                            <a class="link-hover-secondary-primary" href="{{route('index')}}">{{lang_name('Home_Page')}}
                            </a>
                        </li>
                        <li class="list-group-item px-0 lh-1625 bg-transparent py-1">
                            <a class="link-hover-secondary-primary" href="{{route('catalogue')}}">{{lang_name('Catalogue')}}
                            </a>
                        </li>
                        @if(pages_footer1()->count() != 0)
                            @foreach(pages_footer1() as $item)
                                <li class="list-group-item px-0 lh-1625 bg-transparent py-1">
                                    <a href="{{$item->route()}}" class="link-hover-secondary-primary">
                                        {{$item->name()}}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-sm-6 col-lg-4 mb-6 mb-lg-0">
                    <div class="pl-0 pl-lg-9">
                        <div class="font-size-md font-weight-semibold text-dark mb-4">{{lang_name('Subscribe')}}</div>
                        <div class="mb-4">{{lang_name('Subscribe_desc')}}
                        </div>
                        <div class="form-newsletter">
                            <form method="post" class="newsletter ajaxForm" data-name="newsletter" action="{{route('newsletter')}}">
                                {{csrf_field()}}
                                <div class="input-group bg-white">
                                    <input type="text" class="form-control border-0"
                                           id="email" name="email"
                                           placeholder="{{lang_name('Email')}}">
                                    <button type="submit"
                                            class="input-group-append btn btn-white bg-transparent text-dark border-0">
                                        <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-last mt-8 mt-md-11">
        <div class="container">
            <div class="footer-last-container position-relative">
                <div class="row align-items-center">
                    <div class="col-lg-4 mb-3 mb-lg-0">
                        <div class="social-icon text-dark">
                            <ul class="list-inline">
                                @if(hp_contact()->twitter != null)
                                    <li class="list-inline-item mr-5">
                                        <a target="_blank" title="{{lang_name('Twitter')}}" href="{{hp_contact()->twitter}}">
                                            <i class="fab fa-twitter">
                                            </i>
                                            <span>{{lang_name('Twitter')}}</span>
                                        </a>
                                    </li>
                                @endif
                                @if(hp_contact()->facebook != null)
                                    <li class="list-inline-item mr-5">
                                        <a target="_blank" title="{{lang_name('Facebook')}}" href="{{hp_contact()->facebook}}">
                                            <i class="fab fa-facebook-f">
                                            </i>
                                            <span>{{lang_name('Facebook')}}</span>
                                        </a>
                                    </li>
                                @endif
                                @if(hp_contact()->pinterest != null)
                                    <li class="list-inline-item mr-5">
                                        <a target="_blank" title="{{lang_name('YouTube')}}" href="{{hp_contact()->pinterest}}">
                                            <i class="fab fa-youtube"></i>
                                            <span>{{lang_name('YouTube')}}</span>
                                        </a>
                                    </li>
                                @endif
                                @if(hp_contact()->instagram != null)
                                    <li class="list-inline-item mr-5">
                                        <a target="_blank" title="{{lang_name('Instagram')}}" href="{{hp_contact()->instagram}}">
                                            <i class="fab fa-instagram"></i>
                                            <span>{{lang_name('Instagram')}}</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-5 mb-3 mb-lg-0">
                        <div>
                            &copy; {{date('Y')}} <a href="{{route('index')}}"
                                                    class="link-hover-dark-primary font-weight-semibold">
                                {{setting()->name()}}
                            </a> {{lang_name('Copy_Right')}}
                        </div>
                    </div>
                    <div class="back-top text-left text-lg-right gtf-back-to-top">
                        <a href="#" class="link-hover-secondary-primary"><i class="fal fa-arrow-up"></i><span>
                                    {{lang_name('Back_To_Top')}}
                                </span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
