@extends('layouts.backend-master')

@section('title', 'Assign Permission')

@section('css_before')
    <style>
        .block-title strong {
            color: red;
            font-weight: 700;
        }
    </style>
@endsection

@section('content')

    <!-- Breadcrumb -->
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center">
            <nav class="breadcrumb bg-body-light mb-0">
                <a class="breadcrumb-item" href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
                <span class="breadcrumb-item">Menu</span>
                <span class="breadcrumb-item">Permission Management</span>
                <span class="breadcrumb-item active">Assign Permission</span>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->

    <!-- Page Content -->
    <div class="content menu-contain">
        <!-- Menus Create -->
        <div class="row">
            <div class="col-md-12">
                <!-- Menus Create Labels -->
                <div class="block">
                    <form action="{{ route('admin.AssignPermission.update', $menu->id) }}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                <strong>{{ $menu->name }}</strong>
                                <br>Assign Permission
                            </h3>
                            <div class="block-options">
                                <a type="button" class="btn btn-danger" href="{{ url('admin/menu-role-permission') }}">Cancel</a>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Roles</label>
                                        <div class="container checkbox-group required">
                                            @foreach($roles as $i=>$role)
                                                @foreach ($assigned_roles as $assigned_role)
                                                    @if($role->id == $assigned_role['id'])
                                                        <input type="checkbox" id="{{$i}}" name="role_id[]" value="{{ $assigned_role['id'] }}" checked>
                                                        <label for="role_id"> {{ $assigned_role['name'] }}</label><br>
                                                    @endif
                                                @endforeach
                                                @foreach ($unassigned_roles as $unassigned_role)
                                                    @if($role->id == $unassigned_role['id'])
                                                        <input type="checkbox" id="{{$i}}" name="role_id[]" value="{{ $unassigned_role['id'] }}">
                                                        <label for="role_id"> {{ $unassigned_role['name'] }}</label><br>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END Menus Create Labels -->
            </div>
        </div>
        <!-- END Menus Create -->
    </div>
    <!-- END Page Content -->

@endsection

@section('js_after')
    <script src="{{ asset('assets/js/plugins/select2/js/select2.full.js') }}"></script>
    <script type="text/javascript">
        $('.select2').select2();
    </script>
@endsection
