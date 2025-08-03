@extends('layouts.backend-master')

@section('title', 'Edit User Role')

@section('content')

    <!-- Breadcrumb -->
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center">
            <nav class="breadcrumb bg-body-light mb-0">
                <a class="breadcrumb-item" href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a>
                <span class="breadcrumb-item">User Manager</span>
                <a class="breadcrumb-item" href="{{ route('admin.user-roles.index') }}"> User Role</a>
                <span class="breadcrumb-item active">Edit User Role</span>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <!-- User Role Edit -->
        <div class="row">
            <div class="col-md-12">
                <!-- User Role Edit Labels -->
                <div class="block">
                    <form action="{{ route('admin.user-roles.update',$role->id) }}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        @method('PUT')
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Edit User Role</h3>
                            <div class="block-options">
                                <a type="button" class="btn btn-danger" href="{{ route('admin.user-roles.index') }}">Cancel</a>
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>
                        <div class="block-content modify_section">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Role Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Status</label>
                                        <select class="form-control" id="status_id" name="status_id" required>
                                            <option value="2" @if($role->status_id == 2) {{'selected'}} @endif>Unpublish</option>
                                            <option value="1" @if($role->status_id == 1) {{'selected'}} @endif>Publish</option>
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
                                                    @php
                                                        $check_css ='';
                                                        $swt_css ='';
                                                    @endphp
                                                    @foreach($menus as $menu)
                                                        @php
                                                            $check_css = 'fa-square-o';
                                                            $check_new = '';
                                                            $swt_css   = 'off';
                                                        @endphp
                                                        @if(in_array($menu->id, $menu_array))
                                                            @php
                                                                $check_css = 'fa-check-square-o';
                                                                $check_new = 'checked';
                                                                $swt_css   = 'on';
                                                            @endphp
                                                        @endif
                                                        <li>
                                                            <input type="checkbox" name="authorization[]" class="authNavList"
                                                                   id="auth-{{ $menu->id }}" value="{{ $menu->id }}" style="display:none" {!! $check_new !!}>
                                                            <i class="checkbox fa {{ $check_css }} fa-lg" switch="{{ $swt_css }}" data-val="{{ $menu->id }}"></i>
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
                <!-- END User Role Edit Labels -->
            </div>
        </div>
        <!-- END User Role Edit -->
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
