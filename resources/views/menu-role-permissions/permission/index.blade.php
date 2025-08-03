@extends('layouts.backend-master')

@section('title', 'Menus')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')

    <!-- Breadcrumb -->
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center">
            <nav class="breadcrumb bg-body-light mb-0">
                <a class="breadcrumb-item" href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
                <span class="breadcrumb-item">Permission Management</span>
                <span class="breadcrumb-item active">Permission List</span>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <!-- Menus -->
        <div class="content-heading">
            <a href="{{ url('admin/permissions/create') }}">
                <button type="button" class="btn btn-info float-right">
                    <i class="fa fa-plus"></i> | Add New Permissions
                </button>
            </a>
            &nbsp;&nbsp;
            <div class="dropdown float-right"></div>
            Permission List
        </div>
        <div class="block block-rounded">
            <div class="block-content" id="box_content">
                <!-- Menus Table -->
                <table id="menu-table" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Permissions</th>
                            <th>URL</th>
                            <th class="text-center">Status</th>
                            <th>Roles</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $key=>$permission)
                            <tr>
                                <td class="text-center" width="5%">{{ $key+1 }}</td>
                                <td>
                                    <a class="font-w600" href="{{ route('admin.permissions.edit',$permission->id) }}">
                                        {{ $permission->permission_name }} <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td>{{ $permission->url }}</td>
                                <td class="text-center">
                                    @if($permission->is_active == true)
                                        <span class="badge badge-success">Active</span>
                                    @elseif($permission->is_active == false)
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @foreach($permission->rolePermission as $role)
                                        <i class="fa fa-share"></i> {{ $role->role->name }}<br>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.permission.assign', $permission->id) }}" class="btn btn-danger btn-flat">
                                            <i class='fa fa-sign-in'></i> Assign Role
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Permissions</th>
                            <th>URL</th>
                            <th class="text-center">Status</th>
                            <th>Roles</th>
                            <th class="text-center">Action</th>
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
    </script>
@endsection
