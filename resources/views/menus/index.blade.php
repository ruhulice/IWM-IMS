@extends('layouts.backend-master')

@section('title', 'Menus')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <style>
        .m-icon i {
            font-size: 26px !important;
        }
    </style>
@endsection

@section('content')

    <!-- Breadcrumb -->
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center">
            <nav class="breadcrumb bg-body-light mb-0">
                <a class="breadcrumb-item" href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
                <span class="breadcrumb-item">User Manager</span>
                <span class="breadcrumb-item active">Menus</span>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->

    <!-- Extra Large Modal -->
    <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="cat_sort_data">
                    <div class="block block-themed block-transparent mb-0 pb-2">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Hierarchy Setup</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content content_sortable" id="modal_box_content">
                            <div id="content_hrcht"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary sort_submit_btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Extra Large Modal -->

    <!-- Page Content -->
    <div class="content">
        <!-- Menus -->
        <div class="content-heading">
            <a href="{{ route('admin.menus.create') }}">
                <button type="button" class="btn btn-info float-right">
                    <i class="fa fa-plus"></i> | Add New
                </button>
            </a>
            &nbsp;&nbsp;
            <div class="dropdown float-right"></div>
            {{--<a href="javascript:void(0)">
                <button class="btn btn-primary float-right mr-5" data-remote="false" data-toggle="modal" data-target="#myModal" onclick="getSortData()"><i class="fa fa-list"></i> | Sort</button>
            </a>--}}
            Menus List ({{ count($menus) }})
            {{--<div class="dropdown float-left">
                {{ Form::select('menu_option', ['all'=>'All']+$parent_menus, null, ['class'=>'form-control menu_parent', 'id'=>'menu_option', 'onchange'=>'FilterData()']) }}
            </div>--}}
        </div>
        <div class="block block-rounded">
            <div class="block-content" id="box_content">
                <!-- Menus Table -->
                <table id="menu-table" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Icon</th>
                            <th>Name</th>
                            <th>Order</th>
                            <th>Parent</th>
                            <th>URL</th>
                            <th class="text-center">Status</th>
                            <th width="60px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menus as $key=>$menu)
                            <tr>
                                <td class="text-center">{{ $key+1 }}</td>
                                <td class="text-center m-icon">
                                    <i class="{{ $menu->icon }}"></i>
                                </td>
                                <td>{{ $menu->name }}</td>
                                <td>{{ $menu->menu_order }}</td>
                                <td>{{ $menu->parent->name }}</td>
                                <td>{{ $menu->menu_url }}</td>
                                <td class="text-center">
                                    @if(isset($menu->status) && $menu->status->name == 'Active')
                                        <span class="badge badge-success">Active</span>
                                    @elseif(isset($menu->status) && $menu->status->name == 'Inactive')
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.menus.edit',$menu->id) }}" class="btn btn-warning btn-flat"><i class="fa fa-edit"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Icon</th>
                            <th>Name</th>
                            <th>Order</th>
                            <th>Parent</th>
                            <th>URL</th>
                            <th class="text-center">Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
                <!-- END Menus Table -->
            </div>
        </div>
        <!-- END Menus -->
    </div>
    <!-- END Page Content -->

@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-ui/jquery-ui.js') }}"></script>
    <script>
        $(function(){
            $('#menu-table').DataTable();
        });

        function MenuSwitchButton(rowId){
            var menu_id     = rowId;
            var checkStatus = $('#togBtn'+ rowId).val();
            $(".switch-publish-loader-" + rowId).empty();
            $(".switch-publish-loader-" + rowId).append('<i class="fa fa-spinner"></i>');
            $.ajax({
                type   : "get",
                url    : "MenuSwitchUpdate",
                data   : {
                    menu_id: menu_id,
                    checkStatus: checkStatus
                },
                dataType: "json",
                success: function (response) {
                    $('#togBtn' + rowId).empty();
                    $('#togBtn' + rowId).val(response);
                    $(".switch-publish-loader-" + rowId).empty();
                    $(".switch-publish-loader-" + rowId).append('<i class="fa fa-check succ-msg"></i>');
                },
                error  : function () {
                    alert("Some Error Occurred.Please Try Again Later.")
                }
            });
        }

        function FilterData() {
            if ($('#menu_option').val() != '') {
                if ($('#menu_option').val() == '') {
                    alert("Please Select Menu");
                    return;
                }
            }
            contents = $('#box_content');
            contents.empty();
            $.ajax({
                type    : "get",
                url     : "FilteredMenuData",
                data    : {
                    'menu_option'  : $('#menu_option').val()
                },
                dataType: "html",
                success : function (data) {
                    contents.html(data);
                }
            }).fail(function (error_response) {
                $('#error_span').text('Please Fill up all required field(s).');
            });
        }

        /**
         * GET SORT LIST
         */
        function getSortData() {
            if ($('#menu_option').val() != '') {
                if ($('#menu_option').val() == '') {
                    alert("Please Select Menu");
                    return;
                }
            }
            contents = $('#content_hrcht');
            contents.empty();
            $.ajax({
                type    : "get",
                url     : "GetSortMenuData",
                data    : {
                    'menu_option'  : $('#menu_option').val()
                },
                dataType: "html",
                success : function (data) {
                    contents.html(data);
                }
            }).fail(function (error_response) {
                $('#error_span').text('Please Fill up all required field(s).');
            });
        }

        /**
         * SUBMIT SORT LIST
         */
        $('.sort_submit_btn').click(function(){
            var hrch_list = '';
            $('div.content_sortable ul').each(function(index, element) {
                $.each($('li',this), function(){
                    if(hrch_list!='') hrch_list = hrch_list + ',';
                    hrch_list = hrch_list + $(this).attr('data-val');
                });
            });
            var menu_id = $('#menu_option').val();
            $.ajax({
                type    :   "get",
                url     :   "MenuSortListSubmit",
                data    :   {
                    hrch_list : hrch_list,
                    menu_id   : menu_id
                },
                dataType: "json",
                success: function (data) {
                    $('#myModal').modal('hide');
                    alert(data.success);
                },
                error  : function () {
                    alert("Some Error Occurred.Please Try Again Later.")
                }
            });
        });
    </script>
@endsection
