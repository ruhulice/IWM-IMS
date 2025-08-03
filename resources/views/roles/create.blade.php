@extends('layouts.backend-master')

@section('title', 'Create User Role')

@section('content')

    <!-- Breadcrumb -->
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center">
            <nav class="breadcrumb bg-body-light mb-0">
                <a class="breadcrumb-item" href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a>
                <span class="breadcrumb-item">User Manager</span>
                <a class="breadcrumb-item" href="{{ route('admin.user-roles.index') }}"> User Role</a>
                <span class="breadcrumb-item active">Create Role</span>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <!-- User Role Create -->
        <div class="row">
            <div class="col-md-12">
                <!-- User Role Create Labels -->
                <div class="block">
                    <form action="{{ route('admin.user-roles.store') }}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Create Role</h3>
                            <div class="block-options">
                                <a type="button" class="btn btn-danger" href="{{ route('admin.user-roles.index') }}">Cancel</a>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                        <div class="block-content modify_section">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Role Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Role Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Status</label>
                                        <select class="form-control" id="status_id" name="status_id" required>
                                            <option value="1">Publish</option>
                                            <option value="2">Unpublish</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-6">
                                    <div class="modify_section">
                                        <label class="font-weight-bold">Authorization</label>
                                        <div class="input-group input-form">
                                            <div class="form-control auth_nav_list">
                                                <ul>
                                                    @foreach($menus as $menu)
                                                        <li>
                                                            <input type="checkbox" name="authorization[]" class="authNavList"
                                                                   id="auth-{{ $menu->id }}" value="{{ $menu->id }}" style="display:none">
                                                            <i class="checkbox fa fa-square-o fa-lg" switch="off" data-val="{{ $menu->id }}"></i>
                                                            <label class="nav_title">{{ $menu->name }}</label>
                                                            @if(count($menu->childs))
                                                                @include('roles.childMenu',['childs' => $menu->childs])
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </form>
                </div>
                <!-- END User Role Create Labels -->
            </div>
        </div>
        <!-- END User Role Create -->
    </div>
    <!-- END Page Content -->

@endsection

@section('js_after')
    <script type="text/javascript">
        /**
         * User Role NAVIGATION ACCESS
         */
        $('.auth_nav_list .checkbox').click(function(){

            var auth_id = $(this).attr('data-val');

            var switch_con = $(this).attr('switch');

            if(switch_con=='off'){

                $('#auth-'+auth_id).prop('checked',true);

                $(this).removeClass('fa-square-o');

                $(this).addClass('fa-check-square-o');

                $(this).attr('switch','on');

            }else {

                $('#auth-'+auth_id).prop('checked',false);

                $(this).removeClass('fa-check-square-o');

                $(this).addClass('fa-square-o');

                $(this).attr('switch','off');

            }

        });

        /**
            * ALL CHECKED
         */
        $('input[name="all_Check"]').bind('click', function(e){

            if($(this).is(':checked')){

                $.each($('input[name="check[]"]'),function() {

                    $(this).prop('checked',true);

                });

            }else{

                $.each($('input[name="check[]"]'),function() {

                    $(this).prop('checked',false);

                });

            }

        });

        $('.check_all').click(function(){
            var target_class = $(this).attr('target-class');
            $(this).hide(); $('.uncheck_all').css('display','inline-block');

            $('.auth_cat_list .checkbox').each(function(){
                var auth_id = $(this).attr('data-val');

                $('#auth_cat-'+auth_id).prop('checked',true);
                $(this).removeClass('fa-square-o');
                $(this).addClass('fa-check-square-o');
                $(this).attr('switch','on');
            });
        });

        $('.uncheck_all').click(function(){
            var target_class = $(this).attr('target-class');
            $(this).hide(); $('.check_all').css('display','inline-block');

            $('.auth_cat_list .checkbox').each(function(){
                var auth_id = $(this).attr('data-val');

                $('#auth_cat-'+auth_id).prop('checked',false);
                $(this).removeClass('fa-check-square-o');
                $(this).addClass('fa-square-o');
                $(this).attr('switch','off');
            });
        });
    </script>
@endsection
