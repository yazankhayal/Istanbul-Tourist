@extends('dashboard.layouts.app')

@section('title')
    {{$lang->about_page}}
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
                                <form class="ajaxForm dashboard_about_page_2" enctype="multipart/form-data"
                                      data-name="dashboard_about_page_2"
                                      action="{{route('dashboard_about_page_2.post_data')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="modal-body">
                                        <input id="id" name="id" class="cls" type="hidden">
                                        <div class="form-group col-md-12">
                                            <label for="summary">{{$lang->Summary}}</label>
                                    <textarea rows="4" class=" cls  sumernote form-control" name="summary"
                                              id="summary" placeholder="{{$lang->Summary}}"></textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="sub_summary">{{$lang->Sub_Summary}}</label>
                                    <textarea rows="4" class=" cls sumernote form-control" name="sub_summary"
                                              id="sub_summary" placeholder="{{$lang->Sub_Summary}}"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="button_action" id="button_action" value="insert">
                                        <a href="{{route('dashboard_about_page_2.index')}}" class="btn btn-default">
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
                                              action="{{route('dashboard_about_page_2_translate.post_data')}}" method="post">
                                            <div class="modal-body row">
                                                {{csrf_field()}}
                                                <input id="id_current_{{$lang222->id}}" name="id" type="hidden">
                                                <input id="language_id_{{$lang222->id}}" name="language_id" type="hidden"
                                                       value="{{$lang222->id}}">
                                                <input id="hp_contents_id_{{$lang222->id}}" name="hp_contents_id" type="hidden">

                                                <div class="form-group col-md-12">
                                                    <label for="summary_translate">{{$lang->Summary}}</label>
                            <textarea rows="4" class="cls  sumernote form-control" name="summary"
                                      id="summary_translate_{{$lang222->id}}" placeholder="{{$lang->Summary}}"></textarea>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="sub_summary_translate">{{$lang->Sub_Summary}}</label>
                            <textarea rows="4" class="cls  sumernote form-control" name="sub_summary"
                                      id="sub_summary_translate_{{$lang222->id}}" placeholder="{{$lang->Sub_Summary}}"></textarea>
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
                url: "{{route('dashboard_about_page_2_translate.get_data_by_id')}}",
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
                        tinymce.get('summary_translate_' + result.success.language_id).setContent(result.success.summary);
                        tinymce.get('sub_summary_translate_' + result.success.language_id).setContent(result.success.sub_summary);
                    }
                    else{
                        $('#hp_contents_id_'+y).val(x);
                        var ed = '<div class="container"> <div class="row no-gutter"> <div class="col-lg-7"> <div class="about-content"> <div class="sec-title mb-40"> <span class="sub-title">Why Choose Us</span> <h2 class="title mb-0">25+ years experience in gardening &amp; Landscaping</h2> <p class="magin-0 pt-40"> Suspendisse ex neque, sollicitudin in velit eu, luctus gravida nunc. Nulla pul-vinar risus sed metus euismod sodales ut sed nisi. Nulla posuere suscipit finibus. </p> </div> <div class="row"> <div class="col-lg-6"> <ul class="stylelisting ml-34"> <li>Garden Maintenance</li> <li>Paths, Patios and Driveways</li> <li>Pergolas and Timber Structures</li> <li>Trained and qualified staff</li> <li>Individual selection of plants</li> </ul> </div> <div class="col-lg-6"> <ul class="stylelisting ml-34"> <li>Jet Washing</li> <li>Ground Levelling</li> <li>Winter Services</li> <li>Excellent design</li> <li>Available 24/7</li> </ul> </div> </div> <div class="col-lg-12 mt-40"> <div class="btn-part"> <a class="readon light-btn" href="services.html"> View All Services</a> </div> </div> </div> </div> <div class="col-lg-5 img-part"><img class="" alt="test image"> <div class="play-btn"> <a class="pulse-btn popup-videos" href="www.youtube.com/watchccb8.html?v=YLN1Argi7ik"><i class="fa fa-play"></i> <div class="overly-border"></div> </a> </div> </div> </div> </div>';
                        tinymce.get('summary_translate_' + y).setContent(ed);
                        var ed2 = '<div class="container"> <div class="row rs-vertical-middle"> <div class="col-lg-5"> <div class="img-part"> <img src="images/about/a-1.jpg" alt=" About Image"> </div> </div> <div class="col-lg-7 pl-45 md-pl-15 md-mt-60"> <div class="content-services"> <div class="sec-title mb-50"> <span class="sub-title">Why Choose Us</span> <h2 class="title mb-0">We provide reliable<br> ervices with smiles</h2> </div> <div class="row"> <div class="col-lg-6"> <div class="rs-servicest-item pb-35"> <div class="services-icon"> <img src="images/services/item/3.png" alt=" Image Services"> </div> <div class="services-desc"> <h3 class="title">Available 24/7</h3> <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p> </div> </div> </div> <div class="col-lg-6"> <div class="rs-servicest-item pb-35"> <div class="services-icon"> <img src="images/services/item/4.png" alt=" Image Services"> </div> <div class="services-desc"> <h3 class="title">Free quotation</h3> <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p> </div> </div> </div> <div class="col-lg-6"> <div class="rs-servicest-item md-pb-35"> <div class="services-icon"> <img src="images/services/item/5.png" alt=" Image Services"> </div> <div class="services-desc"> <h3 class="title">Creative ideas</h3> <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p> </div> </div> </div> <div class="col-lg-6"> <div class="rs-servicest-item"> <div class="services-icon"> <img src="images/services/item/6.png" alt=" Image Services"> </div> <div class="services-desc"> <h3 class="title">Customer Focused</h3> <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p> </div> </div> </div> </div> </div> </div> </div> </div>';
                        tinymce.get('sub_summary_translate_' + y).setContent(ed2);

                    }
                }
            });
        }

        var Render_Data = function () {
            $.ajax({
                url: "{{ route('dashboard_about_page_2.get_data_by_id') }}",
                method: "get",
                data: {},
                dataType: "json",
                success: function (result) {
                    if (result.success != null) {
                        $('#id').val(result.success.id);
                        $('#hp_contents_id').val(result.success.id);
                        $(window).on('load', function () {
                            tinymce.get('summary').setContent(result.success.summary);
                        });
                        $(window).on('load', function () {
                            tinymce.get('sub_summary').setContent(result.success.sub_summary);
                        });
                    }
                }
            });
        };

    </script>


@endsection
