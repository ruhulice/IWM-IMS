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
                <span class="breadcrumb-item">Menu</span>
                <span class="breadcrumb-item active">Permission Management</span>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <!-- Menus -->
        <div class="content-heading">
            Permission List
        </div>
        <div class="block block-rounded">
            <div class="block-content" id="box_content">
                <!-- Menus Table -->
                <table id="menu-table" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Menu Name</th>
                            <th>URL</th>
                            <th>Assigned Roles</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($menus as $key=>$menu)
                            <tr>
                                <td class="text-center">{{ $key+1 }}</td>
                                <td>{{ $menu->name }}</td>
                                <td>{{ $menu->menu_url }}</td>
                                <td>
                                    @foreach($menu->menuRole as $m_role)
                                        <i class="fa fa-share"></i> {{ $m_role->role->name }}<br>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    @if($menu->status->name == 'Active')
                                        <span class="badge badge-success">Active</span>
                                    @elseif($menu->status->name == 'Inactive')
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.AssignPermission.data',$menu->id) }}" class="btn btn-danger btn-flat">
                                            <i class='fa fa-sign-in'></i> Assign Permission
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Menu Name</th>
                            <th>URL</th>
                            <th>Assigned Roles</th>
                            <th class="text-center">Status</th>
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
