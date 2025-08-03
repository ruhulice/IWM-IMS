@extends('layouts.backend-master')

@section('title', 'User Roles')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')

    <!-- Breadcrumb -->
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center">
            <nav class="breadcrumb bg-body-light mb-0">
                <a class="breadcrumb-item" href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
                <span class="breadcrumb-item">User Manager</span>
                <span class="breadcrumb-item active">User Roles</span>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <!-- Roles -->
        <div class="content-heading">
            <a href="{{ route('admin.user-roles.create') }}">
                <button type="button" class="btn btn-info float-right">
                    <i class="fa fa-plus"></i> | Add New
                </button>
            </a>
            &nbsp;&nbsp;
            User Role List ({{ count($roles) }})
        </div>
        <div class="block block-rounded">
            <div class="block-content" id="box_content">
                <!-- Roles Table -->
                <table id="role-table" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Role Name</th>
                        {{-- <th>Authorization</th> --}}
                        <th>Status</th>
                        <th>#</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $auth_menu = '';
                        $menu_data = '';
                    @endphp
                    @foreach($roles as $key=>$role)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>
                                <a href="{{ route('admin.user-roles.edit',$role->id) }}">
                                    {{ $role->name }}
                                </a>
                            </td>
                            {{-- <td>
                                @php
                                    $menu_data = App\Models\Menu::getAllMenuNameByIds($role->authorization);
                                @endphp
                                {{ $menu_data }}
                            </td> --}}
                            <td>
                                <label class="css-control css-control-success css-switch">
                                    <input class="css-control-input" onclick="RoleSwitchButton({{ $role->id }})" type="checkbox" data-switchery {{ $role->is_active ? 'checked' : ''}} id="togBtn{{ $role->id }}" value="{{ $role->is_active }}">
                                    <span class="css-control-indicator"></span>
                                </label>
                                <div class="pull-right switch-publish-loader-{{ $role->id }}"></div>
                                <!-- {{ $role->status }} -->
                            </td>
                            <td>{{ $role->id }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <!-- <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Role Name</th>
                        {{-- <th>Authorization</th> --}}
                        <th>Status</th>
                        <th>#</th>
                    </tr>
                    </tfoot> -->
                </table>
                <!-- END Roles Table -->
            </div>
        </div>
        <!-- END Roles -->
    </div>
    <!-- END Page Content -->

@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        function RoleSwitchButton(rowId){
            var role_id     = rowId;
            var checkStatus = $('#togBtn'+ rowId).val();
            $(".switch-publish-loader-" + rowId).empty();
            $(".switch-publish-loader-" + rowId).append('<i class="fa fa-spinner"></i>');
            $.ajax({
                type   : "get",
                url    : "RoleSwitchUpdate",
                data   : {
                    role_id: role_id,
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
    </script>
@endsection
