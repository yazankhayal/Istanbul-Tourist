<section class="inner_page_breadcrumb" style="background-image: url('{{setting()->bunner()}}')">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="breadcrumb_content">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('index')}}">{{lang_name('Home_Page')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@yield("title")</li>
                    </ol>
                    <h1 class="breadcrumb_title">@yield("title")</h1>
                </div>
            </div>
        </div>
    </div>
</section>
