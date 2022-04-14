<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="side-header">
        <a class="header-brand1" href="{{route('index')}}">
            <img src="{{$path.$setting->avatar}}" class="header-brand-img desktop-logo" alt="logo">
            <img src="{{$path.$setting->avatar}}" class="header-brand-img toggle-logo" alt="logo">
            <img src="{{$path.$setting->avatar}}" class="header-brand-img light-logo" alt="logo">
            <img src="{{$path.$setting->avatar}}" class="header-brand-img light-logo1" alt="logo">
        </a><!-- LOGO -->
        <a aria-label="Hide Sidebar" class="app-sidebar__toggle ml-auto" data-toggle="sidebar" href="#"></a>
        <!-- sidebar-toggle-->
    </div>
    <div class="app-sidebar__user">
        <div class="dropdown user-pro-body text-center">
            <div class="user-pic">
                <img src="{{$path.$user->avatar}}" alt="{{$user->name}}" class="avatar-xl rounded-circle">
            </div>
            <div class="user-info">
                <h6 class=" mb-0 text-dark">{{$user->name}}</h6>
                <span class="text-muted app-sidebar__user-name text-sm">{{$user->email}}</span>
            </div>
        </div>
    </div>
    <div class="sidebar-navs">
        <ul class="nav  nav-pills-circle">
            <li class="nav-item" data-toggle="tooltip" data-placement="top" title="{{$lang->Home}}">
                <a href="{{route('index')}}" target="_blank" class="nav-link text-center m-2">
                    <i class="fe fe-navigation"></i>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="top" title="{{$lang->Users}}">
                <a href="{{route('dashboard_users.index')}}" class="nav-link text-center m-2">
                    <i class="fe fe-users"></i>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="top" title="{{$lang->Services}}">
                <a href="{{route('dashboard_services.index')}}" class="nav-link text-center m-2">
                    <i class="fe fe-file"></i>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="top" title="{{$lang->LogOff}}">
                <a class="nav-link text-center m-2" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                  document.getElementById('logout-form2').submit();">
                    <i class="fe fe-power"></i>
                </a>
                <form id="logout-form2" action="{{ route('logout') }}"
                      method="POST"
                      style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
    <ul class="side-menu">
        <li><h3>{{$lang->Dashboard}}</h3></li>
        <li class="slide">
            <a class="side-menu__item" href="{{route('dashboard_admin.index')}}"><i class="side-menu__icon ti-home"></i><span class="side-menu__label">
								{{$lang->Dashboard}}</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{route('dashboard_newsletter.index')}}">
                <i class="side-menu__icon fa fa-address-book-o"></i><span class="side-menu__label">
								{{$lang->Newsletter}}</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{route('dashboard_send_email.index')}}">
                <i class="side-menu__icon fa fa-envelope"></i><span class="side-menu__label">
								{{$lang->Send_Email}}</span>
            </a>
        </li>
        <li><h3>{{$lang->About_Page}}</h3></li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon ti-package"></i><span
                        class="side-menu__label">{{$lang->About_Page}}</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a href="{{route('dashboard_about.index')}}" class="slide-item">{{$lang->About}}</a></li>
                <li><a href="{{route('dashboard_address.index')}}" class="slide-item">{{$lang->why}}</a></li>
                <li><a href="{{route('dashboard_testimonials.index')}}" class="slide-item">{{$lang->Testimonials}}</a></li>
                <li><a href="{{route('dashboard_about_page.index')}}" class="slide-item">{{$lang->Banner}}</a></li>
            </ul>
        </li>
        <li><h3>{{$lang->Category_Services}}</h3></li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-edit"></i><span
                        class="side-menu__label">{{$lang->Category_Services}}</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a href="{{route('dashboard_category.add_edit')}}" class="slide-item">{{$lang->Create}}</a></li>
                <li><a href="{{route('dashboard_category.index')}}" class="slide-item">{{$lang->Category_Services}}</a></li>
            </ul>
        </li>
        <li><h3>{{$lang->Catalogue}}</h3></li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-edit"></i><span
                        class="side-menu__label">{{$lang->Catalogue}}</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a href="{{route('dashboard_catalogue.add_edit')}}" class="slide-item">{{$lang->Create}}</a></li>
                <li><a href="{{route('dashboard_catalogue.index')}}" class="slide-item">{{$lang->Catalogue}}</a></li>
            </ul>
        </li>
        <li><h3>{{$lang->Services}}</h3></li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon ti-file"></i><span
                        class="side-menu__label">{{$lang->Services}}</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a href="{{route('dashboard_services.add_edit')}}" class="slide-item">{{$lang->Create}}</a></li>
                <li><a href="{{route('dashboard_services.index')}}" class="slide-item">{{$lang->Services}}</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-dollar"></i><span
                        class="side-menu__label">{{$lang->Blog}}</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a href="{{route('dashboard_posts.index',['type'=>'1'])}}" class="slide-item">{{$lang->Type_Blog}}</a></li>
                <li><a href="{{route('dashboard_posts.index',['type'=>'2'])}}" class="slide-item">{{$lang->Type_Header}}</a></li>
                <li><a href="{{route('dashboard_posts.index',['type'=>'3'])}}" class="slide-item">{{$lang->Type_Footer}} 1</a></li>
                <li><a href="{{route('dashboard_posts.index',['type'=>'4'])}}" class="slide-item">{{$lang->Type_Footer}} 2</a></li>
                <li><a href="{{route('dashboard_posts.add_edit')}}" class="slide-item">{{$lang->Create}}</a></li>
            </ul>
        </li>
        <li><h3>{{$lang->Setting}}</h3></li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon ti-settings"></i><span
                        class="side-menu__label">{{$lang->Setting}}</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a href="{{route('dashboard_setting.index')}}" class="slide-item">{{$lang->Setting}}</a></li>
                <li><a href="{{route('dashboard_city.index')}}" class="slide-item">{{$lang->City}}</a></li>
                <li><a href="{{route('dashboard_adv_block.index')}}" class="slide-item">{{lang_name_dashbaord('adv_block')}}</a></li>
                <li><a href="{{route('dashboard_scripts.index')}}" class="slide-item">{{lang_name_dashbaord('scripts')}}</a></li>
                <li><a href="{{route('dashboard_email_setting.index')}}" class="slide-item">{{lang_name_dashbaord('email_setting')}}</a></li>
                <li><a href="{{route('dashboard_hp_contact_us.index')}}" class="slide-item">{{$lang->Contact_us}}</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{route('dashboard_language.index')}}">
                <i class="side-menu__icon ti-clipboard"></i><span class="side-menu__label">
								{{$lang->Language}}</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{route('dashboard_users.index')}}">
                <i class="side-menu__icon fa fa-users"></i><span class="side-menu__label">
								{{$lang->Users}}</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
										  document.getElementById('logout-form2').submit();">
                <i class="side-menu__icon fa fa-sign-out"></i><span class="side-menu__label">
								{{$lang->LogOff}}</span>
            </a>
            <form id="logout-form2" action="{{ route('logout') }}"
                  method="POST"
                  style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</aside>
