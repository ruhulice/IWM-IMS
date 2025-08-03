@extends('layouts.backend-master')

@section('title', 'Create User')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('assets/css/user_management.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.css') }}">
@endsection

@section('content')

    <!-- Breadcrumb -->
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center">
            <nav class="breadcrumb bg-body-light mb-0">
                <a class="breadcrumb-item" href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a>
                <span class="breadcrumb-item">User Manager</span>
                <a class="breadcrumb-item" href="{{ route('admin.users.index') }}">User List</a>
                <span class="breadcrumb-item active">New User</span>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->

    <!-- Page Content -->
    <div class="content user-contain">
        <!-- Progress Wizards -->
        <h2 class="content-heading">Create User</h2>
        <div class="row">
        <!-- Progress Wizard -->
            <div class="col-md-12">
            <!-- Progress Wizard 2 -->
            <div class="js-wizard-simple block">
                <!-- Wizard Progress Bar -->
                <div class="progress rounded-0" data-wizard="progress" style="height: 8px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <!-- END Wizard Progress Bar -->

                <!-- Step Tabs -->
                <ul class="nav nav-tabs nav-tabs-alt nav-fill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#wizard-progress2-step1" data-toggle="tab">1. Personal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-progress2-step2" data-toggle="tab">2. Password</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-progress2-step3" data-toggle="tab">3. Role and Others</a>
                    </li>
                </ul>
                <!-- END Step Tabs -->

                <!-- Form -->
                <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data" role="form">
                    @csrf
                    <!-- Steps Content -->
                    <div class="block-content block-content-full tab-content" style="min-height: 274px;">
                        <!-- Step 1 -->
                        <div class="tab-pane active" id="wizard-progress2-step1" role="tabpanel">
                            <div class="form-group">
                                <div class="form-material floating">
                                    <input class="form-control" type="text" id="name" name="name" required="required">
                                    <label for="name">Name</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-material floating">
                                    <input class="form-control no-space" type="text" id="user_name" name="user_name" required="required">
                                    <label for="user_name">User ID</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-material floating">
                                    <input class="form-control no-space" type="email" id="email" name="email" required="required">
                                    <label for="email">E-mail</label>
                                </div>
                            </div>
                        </div>
                        <!-- END Step 1 -->

                        <!-- Step 2 -->
                        <div class="tab-pane" id="wizard-progress2-step2" role="tabpanel">
                            <div class="form-group">
                                <div class="form-material floating">
                                    <input class="form-control" type="password" id="password" name="password" required="required">
                                    <label for="password">Password</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-material floating">
                                    <input class="form-control" type="password" id="confirm_password" name="confirm_password" required="required">
                                    <label for="confirm_password">Confirm Password</label>
                                </div>
                            </div>
                        </div>
                        <!-- END Step 2 -->

                        <!-- Step 3 -->
                        <div class="tab-pane" id="wizard-progress2-step3" role="tabpanel">
                            <div class="form-group">
                                <div class="form-material floating">
                                    <select name="role_id[]" id="role_id" size="1" class="form-control select2 role-select" multiple="multiple" required>
                                        @foreach($roles as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="role_id">Role</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-material floating">
                                    <select class="form-control" id="status" name="status" size="1">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                    <label for="status">Status</label>
                                </div>
                            </div>
                        </div>
                        <!-- END Step 3 -->
                    </div>
                    <!-- END Steps Content -->

                    <!-- Steps Navigation -->
                    <div class="block-content block-content-sm block-content-full bg-body-light">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-alt-secondary" data-wizard="prev">
                                    <i class="fa fa-angle-left mr-5"></i> Previous
                                </button>
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-alt-secondary" data-wizard="next">
                                    Next <i class="fa fa-angle-right ml-5"></i>
                                </button>
                                <button type="submit" class="btn btn-alt-primary d-none" data-wizard="finish">
                                    <i class="fa fa-check mr-5"></i> Submit
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- END Steps Navigation -->
                </form>
                <!-- END Form -->
            </div>
            <!-- END Progress Wizard 2 -->
        </div>
        <!-- END Progress Wizard -->
        </div>
    </div>

@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/bootstrap-wizard/jquery.bootstrap.wizard.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('assets/js/pages/be_forms_wizard.min.js') }}"></script>
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
