@extends('layouts.backend-master')

@section('title', 'Create Menu')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('assets/css/user_management.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.css') }}">
@endsection

@section('content')

    <!-- Breadcrumb -->
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center">
            <nav class="breadcrumb bg-body-light mb-0">
                <a class="breadcrumb-item" href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
                <span class="breadcrumb-item">Permission Management</span>
                <span class="breadcrumb-item active">Create Permission</span>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->

    <!-- Page Content -->
    <div class="content menu-contain">
        <!-- Permissions Create -->
        <div class="row">
            <div class="col-md-12">
                <!-- Permissions Create Labels -->
                <div class="block">
                    <form action="{{ route('admin.permissions.store') }}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Create Permission</h3>
                            <div class="block-options">
                                <a type="button" class="btn btn-danger" href="{{ route('admin.permissions.index') }}">Cancel</a>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                {{--<div class="col-md-9">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Base Menu</label>
                                        <select id="menu_id" name="menu_id" class="form-control select2" required>
                                            <option value="" selected> --Select Menu-- </option>
                                            @foreach ($menus as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>--}}
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Permission Name</label>
                                        <input type="text" class="form-control no-space" id="permission_name" name="permission_name" required>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Url</label>
                                        {{--<input type="text" class="form-control no-space" id="url" name="url" required>--}}
                                        <select id="url" name="url" class="form-control select2" required>
                                            <option value="" selected> --Select a URL-- </option>
                                            @foreach ($active_routes as $route)
                                                <option value="{{ $route['url'] }}">{{ $route['url'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END Permissions Create Labels -->
            </div>
        </div>
        <!-- END Permissions Create -->
    </div>
    <!-- END Page Content -->

@endsection

@section('js_after')
    <script src="{{ asset('assets/js/plugins/select2/js/select2.full.js') }}"></script>
    <script type="text/javascript">
        $('.select2').select2();

        $(function(){
            $('.no-space').bind('input', function(){
                $(this).val(function(_, v){
                    return v.replace(/\s+/g, '');
                });
            });
        });
    </script>
@endsection
