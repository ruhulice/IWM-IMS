@extends('layouts.backend-master')

@section('title', 'Profile')

@section('content')

    <!-- Breadcrumb -->
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center">
            <nav class="breadcrumb bg-body-light mb-0">
                <a class="breadcrumb-item" href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
                <span class="breadcrumb-item active"> {{ auth()->user()->name }}'s Profile</span>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <!-- Material Design -->
        <div class="row">
            <div class="col-md-6">
                <!-- Floating Labels -->
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Update Profile</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-wrench"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row modify_section">
                            <div class="col-md-12">
                                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" role="form">
                                    @csrf
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="user_id">User ID</label>
                                            <input type="text" name="user_name" class="form-control" id="user_name" value="{{ $user->user_name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="user_name">User Name</label>
                                            <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="user_code">User Code</label>
                                            <input type="text" name="code" class="form-control" id="code" value="{{ $user->code }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="user_email">User Email</label>
                                            <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}">
                                        </div>
                                        <div class="form-group">
                                            <img src="{{ $user->user_photo }}" alt="User photo not found" width="50%" border="0">
                                            <br><br/>
                                            <input class="form-control" type="file" name="user_picture" id="user_picture">
                                        </div>
                                        <div class="form-group">
                                            <label>Active</label>
                                            <select class="form-control" name="status" id="status" style="width: 100%;">
                                                <option value="0" @if($user->status_id == 0) {{'selected'}} @endif>No</option>
                                                <option value="1" @if($user->status_id == 1) {{'selected'}} @endif>Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary btn-flat">UPDATE</button>
                                        <a type="button" class="btn btn-danger" href="{{ url('/home') }}">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Floating Labels -->
            </div>
            <div class="col-md-6">
                <!-- Floating Labels -->
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Change Password</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-wrench"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row modify_section">
                            <div class="col-md-12">
                                <form action="{{ route('profile.change-password') }}" method="POST" role="form">
                                    @csrf
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="currentpassword">Current Password</label>
                                            <input type="password" name="currentpassword" class="form-control" id="currentpassword">
                                        </div>
                                        <div class="form-group">
                                            <label for="newpassword">New Password</label>
                                            <input type="password" name="newpassword" class="form-control" id="newpassword">
                                        </div>
                                        <div class="form-group">
                                            <label for="newpasconfirm">Confirm Password</label>
                                            <input type="password" name="newpassword_confirmation" class="form-control" id="newpasconfirm">
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary btn-flat">CHANGE PASSWORD</button>
                                        <a type="button" class="btn btn-danger" href="{{ url('/home') }}">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Floating Labels -->
            </div>
        </div>
        <!-- END Material Design -->
    </div>
    <!-- END Page Content -->

@endsection
