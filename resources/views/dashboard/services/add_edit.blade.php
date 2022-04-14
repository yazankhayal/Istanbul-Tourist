@extends('dashboard.layouts.app')

@section('title')
    {{$lang->Services}}
@endsection

@section('create_btn'){{route('dashboard_services.index')}}@endsection
@section('create_btn_btn'){{$lang->Close}}@endsection


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
    <link type="text/css" rel="stylesheet" href="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.css"/>
    <link type="text/css" rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css"/>
    <style>
        .dz-remove {
            display: inline-block !important;
            width: 1.2em;
            height: 1.2em;

            position: absolute;
            top: 5px;
            right: 5px;
            z-index: 1000;

            font-size: 1.5em !important;
            line-height: 1em;

            text-align: center;
            font-weight: bold;
            border: 1px solid gray !important;
            border-radius: 1.2em;
            color: #fff;
            background-color: red;
            opacity: .7;

        }

        .dz-remove:hover {
            text-decoration: none !important;
            opacity: 1;
        }
    </style>
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
                                    <li class="nav-item get_content_language {{dis()}}" data-id="{{$lang222->id}}">
                                        <a class="nav-link" id="{{$lang222->name}}-tab"
                                           data-toggle="tab" href="#{{$lang222->name}}" role="tab"
                                           aria-controls="{{$lang222->name}}" aria-selected="false">
                                            <img class="img_flag" src="{{path().$lang222->avatar}}"
                                                 alt="{{$lang222->name}}">
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>{{$lang->Gallery}}</label>
                                        <form method="post" action="{{route('dashboard_services.uploadjquery')}}"
                                              enctype="multipart/form-data"
                                              class="dropzone" id="dropzone">
                                            {{csrf_field()}}
                                        </form>
                                        <div style="margin: 10px 0;">
                                            <div id="render_gallery" class="d-none row">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form class="ajaxForm post_data" enctype="multipart/form-data"
                                      data-name="post_data"
                                      action="{{route('dashboard_services.post_data')}}" method="post">
                                    {{csrf_field()}}

                                    <input id="id" name="id" class="cls" type="hidden">

                                    <input id="images" name="images" type="hidden">
                                    <input id="old_images" name="old_images" type="hidden">

                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label for="name">{{$lang->Name}}</label>
                                            <input type="text" class="cls form-control" name="name" id="name"
                                                   placeholder="{{$lang->Name}}">
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="sub_name">{{$lang->Sub_Name}}</label>
                                            <input type="text" class="cls form-control" name="sub_name" id="sub_name"
                                                   placeholder="{{$lang->Sub_Name}}">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="city_id">{{$lang->City}}</label>
                                            <select class="cls form-control" name="city_id" id="city_id">
                                                <option>{{$lang->City}}</option>
                                                @if($city_id->count() != 0)
                                                    @foreach($city_id as $item2)
                                                        <option value="{{$item2->id}}">{{$item2->name()}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="category_id">{{$lang->Category_Services}}</label>
                                            <select class="cls form-control" name="category_id" id="category_id">
                                                <option>{{$lang->Category_Services}}</option>
                                                @if($category_id->count() != 0)
                                                    @foreach($category_id as $item2)
                                                        <option value="{{$item2->id}}">{{$item2->name()}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="catalogue_id">{{$lang->Catalogue}}</label>
                                            <select class="cls form-control" name="catalogue_id" id="catalogue_id">
                                                <option>{{$lang->Catalogue}}</option>
                                                @if($catalogue_id->count() != 0)
                                                    @foreach($catalogue_id as $item2)
                                                        <option value="{{$item2->id}}">{{$item2->name()}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="address">{{$lang->address}}</label>
                                            <input type="text" class="cls form-control" name="address" id="address"
                                                   placeholder="{{$lang->address}}">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="iframe">{{$lang->IframeGoogle}}</label>
                                            <input type="text" class="cls form-control" name="iframe" id="iframe"
                                                   placeholder="{{$lang->IframeGoogle}}">
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="verified">{{$lang->verified}}</label>
                                            <br>
                                            <label class="custom-switch">
                                                <input type="checkbox" name="verified" id="verified"
                                                       class="custom-switch-input">
                                                <span class="custom-switch-indicator"></span> <span
                                                    class="custom-switch-description">{{$lang->verified}}</span>
                                            </label>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="summary">{{$lang->Summary}}</label>
                                    <textarea rows="4" class="cls sumernote form-control" name="summary"
                                              id="summary" placeholder="{{$lang->Summary}}"></textarea>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="avatar">{{$lang->Avatar}}</label>
                                            <input type="file" class="cls form-control" name="avatar" id="avatar">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <img style="height: 100px;height: 100px;"
                                                 class="img_usres avatar_view d-none img-thumbnail">
                                        </div>

                                    </div>

                                    <a href="{{route('dashboard_services.index')}}" class="btn btn-default">
                                        {{$lang->Close}}
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-load">
                                        {{$lang->Submit}}
                                    </button>
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
                                              action="{{route('dashboard_services_translate.post_data')}}"
                                              method="post">
                                            <div class="modal-body row">
                                                {{csrf_field()}}
                                                <input id="id_current_{{$lang222->id}}" name="id" type="hidden">
                                                <input id="services_id_{{$lang222->id}}" name="services_id" type="hidden">
                                                <input id="language_id_{{$lang222->id}}" name="language_id" type="hidden"
                                                       value="{{$lang222->id}}">
                                                <div class="form-group col-12">
                                                    <label for="name_translate">{{$lang->Name}}</label>
                                                    <input type="text" class="cls form-control" name="name" id="name_translate_{{$lang222->id}}"
                                                           placeholder="{{$lang->Name}}">
                                                </div>
                                                <div class="form-group col-12">
                                                    <label for="sub_name_translate">{{$lang->Sub_Name}}</label>
                                                    <input type="text" class="cls form-control" name="sub_name"
                                                           id="sub_name_translate_{{$lang222->id}}"
                                                           placeholder="{{$lang->Sub_Name}}">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="summary_translate_">{{$lang->Summary}}</label>
                            <textarea rows="4" class="cls sumernote form-control" name="summary"
                                      id="summary_translate_{{$lang222->id}}" placeholder="{{$lang->Summary}}"></textarea>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-load">
                                                {{$lang->Submit}}
                                            </button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    <script type="text/javascript">

        var images = [];
        var old_images = [];
        Dropzone.options.dropzone =
        {
            maxFilesize: 122,
            renameFile: function (file) {
                var dt = new Date();
                var time = dt.getTime();
                return time + file.name;
            },
            removedfile: function (file) {
                var name = file.upload.filename;
                $.ajax({
                    url: "{{ route('dashboard_services.deleteuploadjquery') }}",
                    method: 'get',
                    data: {filename: name},
                    success: function (result) {
                        images.splice(result);
                        $('#images').val(images);
                    }
                });
                var fileRef;
                return (fileRef = file.previewElement) != null ?
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            dictRemoveFile: "×",
            timeout: 5000,
            success: function (file, response) {
                images.push(response['data']);
                $('#images').val(images);
            },
            error: function (file, response) {
                return false;
            }
        };
        $(document).ready(function () {

            "use strict";
            //Code here.

            var url = $(location).attr('href'),
                    parts = url.split("/"),
                    last_part = parts[parts.length - 1];

            var split = last_part.split("?");

            var name_form = $('.ajaxForm').data('name');

            $(document).on('click', '#btn_submit', function () {
                event.preventDefault(); //prevent default action
                $("#form_submit").submit();
            });

            $(document).on('keypress', '#form_submit input', function (e) {
                if (e.which == 13) {
                    $('#form_submit').submit();
                    return false;    //<---- Add this line
                }
            });

            if (isNaN(split[0]) == false) {
                if (split[0] != null) {
                    $('.title_info').html("{{$lang->Edit}}");
                    Render_Data(split[0]);
                }
            } else {
                $('.title_info').html("{{$lang->Create}}");
            }

            $(document).on('click', '.btn_remove_gallery2', function () {
                var id = $(this).data("id");
                $.ajax({
                    url: "{{ route('dashboard_services.deleteuploadjquery') }}",
                    method: 'get',
                    data: {filename: id, "type": "1"},
                    success: function (result) {
                        var str = $("#old_images").val();
                        var array = str.split(",");
                        var dd = '';
                        $('#render_gallery').html('');
                        $('#render_gallery').removeClass('d-none');
                        for (var i = 0; i < array.length; i++) {
                            var v = array[i];
                            if (v) {
                                if (v != result) {
                                    dd = v + ',' + dd;
                                    var image = v;
                                    var id = v;
                                    var r = '<div class="col-md-3" style="margin-bottom: 20px;"><div class="card">\n' +
                                            '<img data-img="' + geturlphoto() + 'upload/gallery_services/' + image + '" style="width: 100%;80px;" src="' + geturlphoto() + 'upload/gallery_services/' + image + '" class="card-img-top" alt="...">\n' +
                                            '  <div class="card-body">\n' +
                                            '    <button type="button" data-id="' + id + '" class="btn_remove_gallery2 btn btn-primary"><i class="fa fa-trash"></i></button>\n' +
                                            '  </div>\n' +
                                            '</div></div>';
                                    $('#render_gallery').append(r);
                                }
                            }
                        }
                        $("#old_images").val(dd);
                    }
                });
            });

            $(document).on("click",".get_content_language",function(){
               var language_id = $(this).data("id");
                var id = $("#id").val();
                $.ajax({
                    url: "{{route('dashboard_services_translate.get_data_by_id')}}",
                    method: "get",
                    data: {
                        "id": id,
                        "language_id": language_id,
                    },
                    dataType: "json",
                    success: function (result) {
                        if (result.success != null) {
                            $('#id_current_' + result.success.language_id).val(result.success.id);
                            $('#name_translate_' + result.success.language_id).val(result.success.name);
                            $('#sub_name_translate_' + result.success.language_id).val(result.success.sub_name);
                            $('#language_id_' + result.success.language_id).val(result.success.language_id);
                            $('#services_id_' + result.success.language_id).val(result.success.services_id);
                            $('#summary_translate_' + result.success.language_id).summernote("code",result.success.summary);
                        }
                        else{
                            $('#services_id_'+language_id).val(id);
                            $('#summary_translate_'+language_id).summernote("code","");
                        }
                    }
                });
            });

        });

        var Render_Data = function (id) {
            $.ajax({
                url: "{{route('dashboard_services.get_data_by_id')}}",
                method: "get",
                data: {
                    "id": id,
                },
                dataType: "json",
                success: function (result) {
                    if (result.success != null) {
                        $('#id').val(result.success.id);
                        $('#name').val(result.success.name);
                        $('#sub_name').val(result.success.sub_name);
                        $('#city_id').val(result.success.city_id);
                        $('#category_id').val(result.success.category_id);
                        $('#catalogue_id').val(result.success.catalogue_id);

                        $('#address').val(result.success.address);
                        $('#iframe').val(result.success.iframe);
                        if(result.success.verified == "1"){
                            $("#verified").attr("checked","checked");
                        }

                        var ed = result.success.summary;
                        $('#summary').summernote("code",result.success.summary);

                        $('.avatar_view').removeClass('d-none');
                        $('.avatar_view').attr('src', geturlphoto() + result.success.avatar);

                        $('#old_images').val(result.success.images);
                        $('#old_plans').val(result.success.plans);

                        //Images
                        var images = result.success.images;
                        var images_res = images.split(",");
                        if (images_res.length != 0) {
                            $('#render_gallery').html('');
                            $('#render_gallery').removeClass('d-none');
                            for (var i = 0; i < images_res.length; i++) {
                                if (images_res[i]) {
                                    var image = images_res[i];
                                    var id = image;
                                    var r = '<div class="col-md-3" style="margin-bottom: 20px;"><div class="card">\n' +
                                            '<img data-img="' + geturlphoto() + 'upload/gallery_services/' + image + '" style="width: 100%;80px;" src="' + geturlphoto() + 'upload/gallery_services/' + image + '" class="card-img-top" alt="...">\n' +
                                            '  <div class="card-body">\n' +
                                            '    <button type="button" data-id="' + id + '" class="btn_remove_gallery2 btn btn-primary"><i class="fa fa-trash"></i></button>\n' +
                                            '  </div>\n' +
                                            '</div></div>';
                                    $('#render_gallery').append(r);
                                }
                            }
                        }

                    } else {
                        toastr.error('لا يوحد بيانات', 'العمليات');
                        window.location.href = "{{route('dashboard_services.index')}}";
                    }
                }
            });
        };

    </script>
@endsection
