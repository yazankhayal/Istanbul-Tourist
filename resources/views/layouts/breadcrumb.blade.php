<div id="page-title" class="page-title page-title-style-background" style="background-image: url('{{setting()->bunner()}}')">
    <div class="container">
        <div class="h-100 d-flex align-items-center">
            <div class="mb-2">
                <h1 class="mb-0" data-animate="fadeInDown">
                    <span class="font-weight-light">@yield("title")</span>
                </h1>
                <ul class="breadcrumb breadcrumb-style-01" data-animate="fadeInUp">
                    <li class="breadcrumb-item"><a href="{{route('index')}}" class="link-hover-dark-primary">{{lang_name('Home_Page')}}</a></li>
                    <li class="breadcrumb-item"><span>@yield("title")</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
