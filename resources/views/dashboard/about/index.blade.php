@extends('dashboard.layouts.app')

@section('title')
    {{$lang->About}}
@endsection

@section('create_btn')

@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
							<span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
							</span>
                            <h3 class="m-portlet__head-text">
                                @yield('title')
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="form-group m-form__group">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active"
                                   id="home-tab" data-toggle="tab" href="#home"
                                   role="tab" aria-controls="home"
                                   aria-selected="true">
                                    <img class="img_flag" src="{{path().$select_lan_choice->avatar}}"
                                         alt="{{$select_lan_choice->name}}">
                                    {{$select_lan_choice->name}}
                                </a>
                            </li>
                            @if($langauges->where('dir','!=',$select_lan_choice->dir)->count() > 0)
                                @foreach($langauges->where('dir','!=',$select_lan_choice->dir) as $lang222)
                                    <li class="nav-item get_content_language" data-id="{{$lang222->id}}">
                                        <a class="nav-link" id="{{$lang222->name}}-tab"
                                           data-toggle="tab" href="#{{$lang222->name}}" role="tab"
                                           aria-controls="{{$lang222->name}}" aria-selected="false">
                                            <img class="img_flag" src="{{path().$lang222->avatar}}"
                                                 alt="{{$select_lan_choice->name}}">
                                            {{$lang222->name}}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                 aria-labelledby="home-tab">
                                <br>
                                <div class="alert alert-warning">{{$select_lan_choice->name}}</div>
                                <hr>
                                <form class="ajaxForm dashboard_about" enctype="multipart/form-data"
                                      data-name="dashboard_about"
                                      action="{{route('dashboard_about.post_data')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="modal-body">
                                        <input id="id" name="id" class="cls" type="hidden">
                                        <div class="form-group col-md-12">
                                            <label for="summary">{{$lang->Summary}}</label>
                                    <textarea rows="4" class="sumernote cls form-control" name="summary"
                                              id="summary" placeholder="{{$lang->Summary}}"></textarea>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="avatar">{{$lang->Avatar}}</label>
                                            <input type="file" class="cls form-control" name="avatar" id="avatar">
                                        </div>
                                        <div class="form-group col-6">
                                            <img class="img_usres avatar_view d-none img-thumbnail">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="button_action" id="button_action" value="insert">
                                        <a href="{{route('dashboard_about.index')}}" class="btn btn-default">
                                            {{$lang->Close}}
                                        </a>
                                        <button type="submit" class="btn btn-primary btn-load">
                                            {{$lang->Submit}}
                                        </button>
                                    </div>
                                </form>
                            </div>
                            @if($langauges->where('dir','!=',$select_lan_choice->dir)->count() > 0)
                                @foreach($langauges->where('dir','!=',$select_lan_choice->dir) as $lang222)
                                    <div class="tab-pane fade tab_{{$lang222->id}}" id="{{$lang222->name}}" role="tabpanel"
                                         aria-labelledby="{{$lang222->name}}-tab">
                                        <br>
                                        <div class="alert alert-warning">{{$lang222->name}}</div>
                                        <hr>
                                        <form class="ajaxForm translate" data-name="translate"
                                              action="{{route('dashboard_about_translate.post_data')}}" method="post">
                                            <div class="modal-body row">
                                                {{csrf_field()}}
                                                <input id="id_current_{{$lang222->id}}" name="id" type="hidden">
                                                <input id="language_id_{{$lang222->id}}" name="language_id" type="hidden"
                                                       value="{{$lang222->id}}">
                                                <input id="hp_contents_id_{{$lang222->id}}" name="hp_contents_id" type="hidden">

                                                <div class="form-group col-md-12">
                                                    <label for="summary_translate">{{$lang->Summary}}</label>
                            <textarea rows="4" class="cls sumernote form-control" name="summary"
                                      id="summary_translate_{{$lang222->id}}" placeholder="{{$lang->Summary}}"></textarea>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    {{$lang->Close}}
                                                </button>
                                                <button type="submit" class="btn btn-primary btn-load">
                                                    {{$lang->Submit}}
                                                </button>
                                            </div>
                                        </form>
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


@section('js')

    <script type="text/javascript">
        $(document).ready(function () {
            "use strict";

            Render_Data();


            $(document).on("click",".get_content_language",function(){
                var language_id = $(this).data("id");
                var id = $("#id").val();
                other(id,language_id);
                Render_Data();
            });


        });

        var other = function(x,y){
            $.ajax({
                url: "{{route('dashboard_about_translate.get_data_by_id')}}",
                method: "get",
                data: {
                    "id": x,
                    "language_id": y,
                },
                dataType: "json",
                success: function (result) {
                    if (result.success != null) {
                        $('#id_current_' + result.success.language_id).val(result.success.id);
                        $('#language_id_' + result.success.language_id).val(result.success.language_id);
                        $('#hp_contents_id_' + result.success.language_id).val(result.success.hp_contents_id);
                        $('#summary_translate_' + result.success.language_id).summernote("code", result.success.summary);
                    }
                    else{
                        $('#hp_contents_id_'+y).val(x);
                        var edt = '<div class="row"><div class="col-lg-6 offset-lg-3"><div class="main-title text-center"><h2 class="mt0">Our Mission Is To Alyaqut</h2></div></div></div><div class="row"><div class="col-lg-8 col-xl-7"><div class="about_content"><p class="large">Mauris ac consectetur ante, dapibus gravida tellus. Nullam aliquet eleifend dapibus. Cras sagittis, ex euismod lacinia tempor.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque quis ligula eu lectus vulputate porttitor sed feugiat nunc. Mauris ac consectetur ante, dapibus gravida tellus. Nullam aliquet eleifend dapibus. Cras sagittis, ex euismod lacinia tempor, lectus orci elementum augue, eget auctor metus ante sit amet velit.</p><p>Maecenas quis viverra metus, et efficitur ligula. Nam congue augue et ex congue, sed luctus lectus congue. Integer convallis condimentum sem. Duis elementum tortor eget condimentum tempor. Praesent sollicitudin lectus ut pharetra pulvinar. Donec et libero ligula. Vivamus semper at orci at placerat.Placeat Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod libero amet, laborum qui nulla quae alias tempora.</p><ul class="ab_counting"><li class="list-inline-item"><div class="about_counting"><div class="icon"><span class="flaticon-user"></span></div><div class="details"><h3>80,123</h3><p>Customers to date</p></div></div></li><li class="list-inline-item"><div class="about_counting"><div class="icon"><span class="flaticon-home"></span></div><div class="details"><h3>$74 Billion</h3><p>In home sales</p></div></div></li><li class="list-inline-item"><div class="about_counting"><div class="icon"><span class="flaticon-transfer"></span></div><div class="details"><h3>$468 Million</h3><p>In Savings</p></div></div></li></ul></div></div><div class="col-lg-4 col-xl-5"><div class="about_thumb"><img class="img-fluid w100" src="images/about/1.jpg" alt="1.jpg"><a class="popup-iframe popup-youtube color-white" href="https://www.youtube.com/watch?v=R7xbhKIiw4Y"><i class="flaticon-play"></i></a></div></div></div>';
                        $('#summary_translate_' + y).summernote("code", edt);
                    }
                }
            });
        }

        var Render_Data = function () {
            $.ajax({
                url: "{{ route('dashboard_about.get_data_by_id') }}",
                method: "get",
                data: {},
                dataType: "json",
                success: function (result) {
                    if (result.success != null) {
                        $('#id').val(result.success.id);
                        $('#hp_contents_id').val(result.success.id);
                        $('.avatar_view').removeClass('d-none');
                        $('.avatar_view').attr('src', geturlphoto() + result.success.avatar1);
                        var ed = result.success.summary;
                        $("#summary").summernote("code", ed);
                    }
                    else{
                        var edt = '<div class="row"><div class="col-lg-6 offset-lg-3"><div class="main-title text-center"><h2 class="mt0">Our Mission Is To Alyaqut</h2></div></div></div><div class="row"><div class="col-lg-8 col-xl-7"><div class="about_content"><p class="large">Mauris ac consectetur ante, dapibus gravida tellus. Nullam aliquet eleifend dapibus. Cras sagittis, ex euismod lacinia tempor.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque quis ligula eu lectus vulputate porttitor sed feugiat nunc. Mauris ac consectetur ante, dapibus gravida tellus. Nullam aliquet eleifend dapibus. Cras sagittis, ex euismod lacinia tempor, lectus orci elementum augue, eget auctor metus ante sit amet velit.</p><p>Maecenas quis viverra metus, et efficitur ligula. Nam congue augue et ex congue, sed luctus lectus congue. Integer convallis condimentum sem. Duis elementum tortor eget condimentum tempor. Praesent sollicitudin lectus ut pharetra pulvinar. Donec et libero ligula. Vivamus semper at orci at placerat.Placeat Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod libero amet, laborum qui nulla quae alias tempora.</p><ul class="ab_counting"><li class="list-inline-item"><div class="about_counting"><div class="icon"><span class="flaticon-user"></span></div><div class="details"><h3>80,123</h3><p>Customers to date</p></div></div></li><li class="list-inline-item"><div class="about_counting"><div class="icon"><span class="flaticon-home"></span></div><div class="details"><h3>$74 Billion</h3><p>In home sales</p></div></div></li><li class="list-inline-item"><div class="about_counting"><div class="icon"><span class="flaticon-transfer"></span></div><div class="details"><h3>$468 Million</h3><p>In Savings</p></div></div></li></ul></div></div><div class="col-lg-4 col-xl-5"><div class="about_thumb"><img class="img-fluid w100" src="images/about/1.jpg" alt="1.jpg"><a class="popup-iframe popup-youtube color-white" href="https://www.youtube.com/watch?v=R7xbhKIiw4Y"><i class="flaticon-play"></i></a></div></div></div>';
                        $("#summary").summernote("code", edt);
                    }
                }
            });
        };

    </script>


@endsection
