@extends('dashboard.layouts.app')

@section('title')
    {{$lang->Setting}}
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
                                    <img class="img_flag" src="{{path().$select_lan->avatar}}"
                                         alt="{{$select_lan->name}}">
                                    {{$select_lan->name}}
                                </a>
                            </li>
                            @if($langauges->where('dir','!=',app()->getLocale())->count() > 0)
                                @foreach($langauges->where('dir','!=',app()->getLocale()) as $lang222)
                                    <li class="nav-item get_content_language" data-id="{{$lang222->id}}">
                                        <a class="nav-link" id="{{$lang222->name}}-tab"
                                           data-toggle="tab" href="#{{$lang222->name}}" role="tab"
                                           aria-controls="{{$lang222->name}}" aria-selected="false">
                                            <img class="img_flag" src="{{path().$lang222->avatar}}"
                                                 alt="{{$select_lan->name}}">
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
                                <div class="alert alert-warning">{{$select_lan->name}}</div>
                                <hr>
                                <form class="ajaxForm dashboard_setting" enctype="multipart/form-data"
                                      data-name="dashboard_setting"
                                      action="{{route('dashboard_setting.post_data')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="modal-body">
                                        <input id="id" name="id" class="cls" type="hidden">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="name">{{$lang->Name}}</label>
                                                <input type="text" class="cls form-control" name="name" id="name"
                                                       placeholder="{{$lang->Name}}">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="summary">{{$lang->Summary}}</label>
                                        <textarea rows="4" class="cls  form-control" name="summary"
                                                  id="summary" placeholder="{{$lang->Summary}}"></textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="avatar">{{$lang->Avatar}}</label>
                                                <input type="file" class="cls form-control" name="avatar" id="avatar">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <img style="width: 80px;height: 80px;"
                                                     class="img_usres avatar_view d-none img-thumbnail">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="fav">{{$lang->Fav}}</label>
                                                <input type="file" class="cls form-control" name="fav" id="fav">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <img style="width: 80px;height: 80px;"
                                                     class="img_usres fav_view d-none img-thumbnail">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="avatar1">{{$lang->Avatar}}</label>
                                                <input type="file" class="cls form-control" name="avatar1" id="avatar1">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <img style="width: 80px;height: 80px;"
                                                     class="img_usres avatar1_view d-none img-thumbnail">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="bunner">{{$lang->Bunner}}</label>
                                                <input type="file" class="cls form-control" name="bunner" id="bunner">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <img style="width: 80px;height: 80px;"
                                                     class="img_usres bunner_view d-none img-thumbnail">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="button_action" id="button_action" value="insert">
                                        <a href="{{route('dashboard_setting.index')}}" class="btn btn-default">
                                            {{$lang->Close}}
                                        </a>
                                        <button type="submit" class="btn btn-primary btn-load">
                                            {{$lang->Submit}}
                                        </button>
                                    </div>
                                </form>
                            </div>
                            @if($langauges->where('dir','!=',app()->getLocale())->count() > 0)
                                @foreach($langauges->where('dir','!=',app()->getLocale()) as $lang222)
                                    <div class="tab-pane fade tab_{{$lang222->id}}" id="{{$lang222->name}}" role="tabpanel"
                                         aria-labelledby="{{$lang222->name}}-tab">
                                        <br>
                                        <div class="alert alert-warning">{{$lang222->name}}</div>
                                        <hr>
                                        <form class="ajaxForm translate" data-name="translate"
                                              action="{{route('dashboard_setting_translate.post_data')}}" method="post">
                                            <div class="modal-body row">
                                                {{csrf_field()}}

                                                <input id="id_translate_{{$lang222->id}}" name="id" type="hidden">
                                                <input id="language_id_{{$lang222->id}}" name="language_id" type="hidden" value="{{$lang222->id}}">
                                                <input id="setting_id_{{$lang222->id}}" name="setting_id" type="hidden">

                                                <div class="form-group col-md-12">
                                                    <label for="name_translate">{{$lang->Name}}</label>
                                                    <input type="text" class="cls form-control" name="name" id="name_translate_{{$lang222->id}}"
                                                           placeholder="{{$lang->Name}}">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="summary_translate">{{$lang->Summary}}</label>
                            <textarea rows="4" class="cls  form-control" name="summary"
                                      id="summary_translate_{{$lang222->id}}" placeholder="{{$lang->Summary}}"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
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
                url: "{{route('dashboard_setting_translate.get_data_by_id')}}",
                method: "get",
                data: {
                    "id": x,
                    "language_id": y,
                },
                dataType: "json",
                success: function (result) {
                    if (result.success != null) {
                        console.log(result);
                        $('#id_current_' + result.success.language_id).val(result.success.id);
                        $('#name_translate_' + result.success.language_id).val(result.success.name);
                        $('#summary_translate_' + result.success.language_id).val(result.success.summary);
                        $('#language_id_' + result.success.language_id).val(result.success.language_id);
                        $('#setting_id_' + result.success.language_id).val(result.success.setting_id);
                    }
                    else{
                        $('#setting_id_'+y).val(x);
                    }
                }
            });
        }

        var Render_Data = function () {
            $.ajax({
                url: "{{ route('dashboard_setting.get_data_by_id') }}",
                method: "get",
                data: {},
                dataType: "json",
                success: function (result) {
                    if (result.success != null) {
                        $('#id').val(result.success.id);
                        $('#setting_id').val(result.success.id);
                        $('#name').val(result.success.name);
                        $('#summary').val(result.success.summary);
                        $('.avatar_view').removeClass('d-none');
                        $('.avatar1_view').removeClass('d-none');
                        $('.bunner_view').removeClass('d-none');
                        $('.contact_view').removeClass('d-none');
                        $('.footer_view').removeClass('d-none');
                        $('.fav_view').removeClass('d-none');
                        $('.avatar_view').attr('src', geturlphoto() + result.success.avatar);
                        $('.avatar1_view').attr('src', geturlphoto() + result.success.avatar1);
                        $('.bunner_view').attr('src', geturlphoto() + result.success.bunner);
                        $('.contact_view').attr('src', geturlphoto() + result.success.contact);
                        $('.footer_view').attr('src', geturlphoto() + result.success.footer);
                        $('.fav_view').attr('src', geturlphoto() + result.success.fav);
                    }
                }
            });
        };

    </script>


@endsection
