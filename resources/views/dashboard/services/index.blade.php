@extends('dashboard.layouts.app')

@section('title')
    {{$lang->Services}}
@endsection

@section('create_btn'){{route('dashboard_services.add_edit')}}@endsection
@section('create_btn_btn'){{$lang->Create}}@endsection

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
                        <table class="table data_Table table-bordered" id="data_Table">
                            <thead>
                            <th>{{$lang->ID}}</th>
                            <th>{{$lang->Name}}</th>
                            <th>{{$lang->Avatar}}</th>
                            <th>{{$lang->Primary}}</th>
                            <th>{{$lang->Featured}} 1</th>
                            <th>{{$lang->Featured}} 2</th>
                            <th>{{$lang->Option}}</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script type="text/javascript">
        var ary_data_amen = '[]';
        $(document).ready(function () {

            var datatabe;

            "use strict";
            //Code here.
            Render_Data();

            var name_form = $('.ajaxForm').data('name');

            $(document).on('click', '.btn_delete_current', function () {
                var id = $(this).data("id");
                $('#ModDelete').modal('show');
                $('#iddel').val(id);
                if (id) {
                    $('#data_Table tbody tr').css('background', 'transparent');
                    $('#data_Table tbody #' + id).css('background', 'hsla(64, 100%, 50%, 0.36)');
                }
            });

            $(document).on('click', '.btn_home_1', function () {
                var id = $(this).data("id");
                if(id){
                    $('#data_Table tbody #' + id).css('background','hsla(64, 100%, 50%, 0.36)');
                }
                $.ajax({
                    url:"{{ route('dashboard_services.home_1') }}",
                    method:"get",
                    data : {
                        "id" : id,
                    },
                    dataType:"json",
                    success:function(result)
                    {
                        if(result.error != null){
                            toastr.error(result.error);
                        }
                        else{
                            toastr.success(result.success);
                        }
                        $('#data_Table').DataTable().ajax.reload();
                    }
                });
            });

            $(document).on('click', '.btn_home_2', function () {
                var id = $(this).data("id");
                if(id){
                    $('#data_Table tbody #' + id).css('background','hsla(64, 100%, 50%, 0.36)');
                }
                $.ajax({
                    url:"{{ route('dashboard_services.home_2') }}",
                    method:"get",
                    data : {
                        "id" : id,
                    },
                    dataType:"json",
                    success:function(result)
                    {
                        if(result.error != null){
                            toastr.error(result.error);
                        }
                        else{
                            toastr.success(result.success);
                        }
                        $('#data_Table').DataTable().ajax.reload();
                    }
                });
            });

            $('.btn_deleted').on("click", function () {
                var id = $('#iddel').val();
                $.ajax({
                    url: "{{ route('dashboard_services.deleted') }}",
                    method: "get",
                    data: {
                        "id": id,
                    },
                    dataType: "json",
                    success: function (result) {
                        toastr.error(result.error);
                        $('.modal').modal('hide');
                        $('#data_Table').DataTable().ajax.reload();
                    }
                });
            });

        });

        var Render_Data = function () {
            datatabe = $('#data_Table').DataTable({
                "language": {
                    aria: {
                        sortAscending: "{{$lang->sortAscending}}",
                        sortDescending: "{{$lang->sortDescending}}"
                    }
                    ,
                    emptyTable: "{{$lang->emptyTable}}",
                    info: "{{$lang->info}}",
                    infoEmpty: "{{$lang->emptyTable}}",
                    infoFiltered: "{{$lang->infoFiltered}}",
                    lengthMenu: "_MENU_",
                    search: "{{$lang->search}}",
                    zeroRecords: "{{$lang->emptyTable}}",
                    paginate: {
                        sFirst: "{{$lang->paginate_sFirst}}",
                        sLast: "{{$lang->paginate_sLast}}",
                        sNext: "{{$lang->paginate_sNext}}",
                        sPrevious: "{{$lang->paginate_sPrevious}}",
                    }
                },
                "processing": true,
                "serverSide": true,
                "bStateSave": true,
                "fnCreatedRow": function (nRow, aData, iDataIndex) {
                    $(nRow).attr('id', aData['id']);
                },
                "ajax": {
                    "url": "{{ route('dashboard_services.get_data') }}",
                    "dataType": "json",
                    "type": "post",
                    "data": {
                        _token: "{{csrf_token()}}",
                    }
                },
                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "avatar"},
                    {"data": "language"},
                    {"data": "home_1"},
                    {"data": "home_2"},
                    {"data": "options"}
                ]
            });
        };

    </script>


@endsection
