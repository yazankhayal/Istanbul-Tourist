<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" dir="{{app()->getLocale() == "ar" ? "rtl" : "ltr"}}">
<head>
    @includeIf('dashboard.layouts.css')
    @yield('css')
</head>

<body class="app sidebar-mini">

<!-- GLOBAL-LOADER
<div id="global-loader">
    <img src="{{$path}}files/dash_board/images/loader.svg" class="loader-img" alt="Loader">
</div>
 /GLOBAL-LOADER -->

<!-- PAGE -->
<div class="page">

    <div class="page-main">


        <!--APP-SIDEBAR-->
    @if($user->role == 1)
        @includeIf('dashboard.layouts.sidebar')
    @elseif($user->role == 2)
        @includeIf('dashboard.layouts.sidebar_ed')
    @elseif($user->role == 3)
        @includeIf('dashboard.layouts.sidebar_su')
    @endif
    <!--/APP-SIDEBAR-->

        <!-- Mobile Header -->
    @includeIf('dashboard.layouts.mobile')
    <!-- /Mobile Header -->

        <!--app-content open-->
        <div class="app-content">
            <div class="side-app">

                @includeIf('dashboard.layouts.breadcrumb')
                @includeIf('layouts.msg')
                <div class="card">
                    <div class="card-header">
                        <div class="col-md-12">
                            @yield("content")
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-md-12 col-sm-12 text-center">
                    Copyright © 2020 All rights reserved.
                </div>
            </div>
        </div>
    </footer>
    <!-- FOOTER END -->
</div>


<div class="modal" id="ModDelete" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('delete.title')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{csrf_field()}}
                <input id="iddel" name="id" type="hidden">
                <p class="text-danger">
                    @lang('delete.desc')
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn_deleted btn btn-primary">Yes</button>
            </div>
        </div>
    </div>
</div>

<!-- whatsapp_fixed -->
<div id="whatsapp_fixed">
    <a href="https://api.whatsapp.com/send?1=pt_BR&phone=905383811159" target="_blank">
        <i class="fa fa-question"></i>
    </a>
    <div class="light"></div>
</div>

@includeIf('dashboard.layouts.js')]
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
@yield('js')
<script>
    var step_wizard = 1;
    var geturlphoto = function () {
        return "{{$setting->public}}";
    };
    var sweet_alert = function (title, text, icon, button) {
        swal({
            title: title,
            text: text,
            icon: icon,
            button: button,
        });
    }
    $(document).ready(function () {
        "use strict";
        //Code here.
        $('.sumernote').summernote({
            placeholder: "Let's write",
            height: 400,
            fontSizes: ['12', '14', '16', '18', '24', '36', '48'],
            toolbar: [
                ['fontname', ['fontname']],
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['picture', 'myvideo', 'link', 'table', 'hr']],
                ['misc', ['fullscreen', 'undo', 'redo','codeview']]
            ],
            disableDragAndDrop: true,
            shortcut: false
        });


        // $( ".date" ).datepicker();
        $(document).on('click', '.btn_current_lan', function () {
            $('.trans').val('');
            $('.trans2').summernote('code', '');
        });

        $('.PopUp').on("click", function () {
            $('#button_action').val('insert');
            $('.form-control').val('');
            $('#id').val('');
            $('.sumernote').summernote('code', '');
            $('.avatar_view').addClass('d-none');
            $('.error').remove();
            $('.form-control').removeClass('border-danger');
        });

        $(document).ajaxStart(function () {
            NProgress.start();
        });
        $(document).ajaxStop(function () {
            NProgress.done();
        });
        $(document).ajaxError(function () {
            NProgress.done();
        });

        $('.modal .close').on("click", function () {
            $('#data_Table tbody tr').css('background', 'transparent');
        });

        $('.modal .btn-secondary').on("click", function () {
            $('#data_Table tbody tr').css('background', 'transparent');
        });

        $('.modal .btn-default').on("click", function () {
            $('#data_Table tbody tr').css('background', 'transparent');
        });

        $(document).on('keyup', function (evt) {
            if (evt.keyCode == 27) {
                $('#data_Table tbody tr').css('background', 'transparent');
            }
        });

    });
</script>

</body>

</html>
