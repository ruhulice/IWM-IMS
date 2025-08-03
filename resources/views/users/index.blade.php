@extends('layouts.backend-master')
@section('title', 'User List')
@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
    <!-- Breadcrumb -->
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center">
            <nav class="breadcrumb bg-body-light mb-0">
                <a class="breadcrumb-item" href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a>
                <span class="breadcrumb-item">User Manager</span>
                <span class="breadcrumb-item active">User List</span>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <!-- Users -->
        <div class="content-heading">
            <div class="dropdown float-right">&nbsp;</div>
            <a href="{{ route('admin.users.create') }}">
                <button type="button" class="btn btn-info float-right">
                    <i class="fa fa-plus"></i> | Add New
                </button>
            </a>
            &nbsp;&nbsp;
            <div class="dropdown float-left">
                <select class="form-control" id="filter_type" size="1" onchange="FilterData()">
                    <option value="all"><i class="fa fa-fw fa-circle-o text-info mr-5"></i>All</option>
                    <option value="active" selected><i class="fa fa-fw fa-star text-warning mr-5"></i>Active User</option>
                    <option value="inactive"><i class="fa fa-fw fa-warning text-danger mr-5"></i>In Active User</option>
                </select>
            </div>
            <div class="dropdown float-left">&nbsp;</div>
            &nbsp;&nbsp;
            <div class="dropdown float-left">
                <div id="all" style="display: none">User List ({{ count($users->get()) }})</div>
                <div id="active" style="display: none">User List ({{ count($users->where('is_active', 'true')->get()) }})</div>
                <div id="inactive" style="display: none">User List ({{ count($users->where('is_active', 'false')->get()) }})</div>
            </div>
            &nbsp;&nbsp;
        </div>

        <div class="block block-rounded">
            <div class="block-content" id="box_content">
                <!-- Users Table -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="user_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th style="">User Name</th>
                            <th class="d-none d-sm-table-cell">Info</th>
                            <th class="d-none d-sm-table-cell">Roles</th>
                            <th class="d-none d-sm-table-cell">Status</th>
                            <!-- <th class="text-right">#</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users->get() as $key=>$user)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    <a class="font-w600" href="{{ route('admin.users.edit',$user->id) }}">{{ $user->name }}</a>
                                </td>
                                <td>
                                    <div>User ID: {{ $user->user_name }}</div>
                                    <div>Email: <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></div>
                                </td>
                                <td>
                                    <div>
                                        @foreach($user->role as $user_role)
                                            <i class="fa fa-share"></i> {{ $user_role->role->name }}<br>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <label class="css-control css-control-success css-switch">
                                        <input class="css-control-input" onclick="UserSwitchButton({{ $user->id }})" type="checkbox" data-switchery {{ $user->is_active ? 'checked' : ''}} id="togBtn{{ $user->id }}" value="{{ $user->is_active }}">
                                        <span class="css-control-indicator"></span>
                                    </label>
                                    <div class="pull-right switch-publish-loader-{{ $user->id }}"></div>
                                </td>
                                <!-- <td class="text-right">{{ $user->id }}</td> -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- END Users Table -->
            </div>
        </div>
        <!-- END Users -->
    </div>
    <!-- END Page Content -->
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $('#user_table').DataTable();
        });

        $(document).ready(function(){
            FilterData();
        });
        function FilterData() {
            if ($('#filter_type').val() != '') {
                if ($('#filter_type').val() == '') {
                    alert("Please select filter type");
                    return;
                }
            }
            $ftype   = $('#filter_type').val();
            if($ftype == 'all'){
                $("#"+$ftype).show();
                $("#active").hide();
                $("#inactive").hide();
            }else if($ftype == 'active'){
                $("#"+$ftype).show();
                $("#all").hide();
                $("#inactive").hide();
            }else if($ftype == 'inactive'){
                $("#"+$ftype).show();
                $("#all").hide();
                $("#active").hide();
            }
            contents = $('#box_content');
            contents.empty();
            $.ajax({
                type    : "get",
                url     : "FilteredUserData",
                data    : {
                    'filter_type'  : $('#filter_type').val()
                },
                dataType: "html",
                success : function (data) {
                    contents.html(data);
                }
            }).fail(function (error_response) {
                $('#error_span').text('Please fill up all required field(s).');
            });
        }

        function UserSwitchButton(rowId){
            var user_id     = rowId;
            var checkStatus = $('#togBtn'+ rowId).val();
            $(".switch-publish-loader-" + rowId).empty();
            $(".switch-publish-loader-" + rowId).append('<i class="fa fa-spinner"></i>');
            $.ajax({
                type   : "get",
                url    : "UserSwitchUpdate",
                data   : {
                    user_id: user_id,
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
                    alert("Some error occurred. Please try again later.")
                }
            });
        }
    </script>
@endsection
