@extends('layouts.backend-master')

@section('title', 'Project Create')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}">
@endsection

@section('content')

    <!-- Breadcrumb -->
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center">
            <nav class="breadcrumb bg-body-light mb-0">
                <a class="breadcrumb-item" href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
                <span class="breadcrumb-item">ICT Projects</span>
                <a class="breadcrumb-item" href="{{ route('admin.projects.index') }}">Project List</a>
                <span class="breadcrumb-item active">Create Project</span>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <!-- Progress Wizards -->
        <div class="row">
            <div class="col-md-12">
                <!-- Project Create Labels -->
                <div class="block">
                    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Create Project</h3>
                            <div class="block-options">
                                <a type="button" class="btn btn-danger" href="{{ route('admin.projects.index') }}">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="row modify_section">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Title <span style="color:#EF5452">*</span></label>
                                                <input type="text" class="form-control" id="title" name="title" placeholder="Title" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Project No. <span style="color:#EF5452">*</span></label>
                                                <input type="text" class="form-control" id="project_no" name="project_no" placeholder="Project No." >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">PL Name <span style="color:#EF5452">*</span></label>
                                                <input type="text" class="form-control" id="assign_pl_name" name="assign_pl_name" placeholder="PL Name" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">PS Name <span style="color:#EF5452">*</span></label>
                                                <input type="text" class="form-control" id="assign_ps_name" name="assign_ps_name" value="ALD" placeholder="PS Name" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Client Name <span style="color:#EF5452">*</span></label>
                                                <input type="text" class="form-control" id="client_name" name="client_name" placeholder="Client Name" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Type of Submission <span style="color:#EF5452">*</span></label>
                                                <input type="text" class="form-control" id="submission_type_name" name="submission_type_name" placeholder="Type of Submission" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Budget (BDT) </label>
                                                <input type="number" class="form-control" id="budget" name="budget" value=0 placeholder="Budget (BDT)">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Association <span style="color:#EF5452">*</span></label>
                                                <input type="text" class="form-control" id="association" name="association" placeholder="Association" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Partner JV Share </label>
                                                <input type="text" class="form-control" id="partner_jv_share" name="partner_jv_share" placeholder="Partner JV Share">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <i class="fa fa-calendar icon-calendar"></i> <label class="font-weight-bold">Date of Submission <span style="color:#EF5452">*</span></label>
                                                <input type="text" data-format="yyyy-mm-dd" class="form-control" id="submission_date" name="submission_date" value="{{ date('Y-m-d') }}" placeholder="Date of Submission" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Technical Score </label>
                                                <input type="number" class="form-control" id="tech_score" name="tech_score" value=0 placeholder="Technical Score">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Financial Score </label>
                                                <input type="number" class="form-control" id="fin_score" name="fin_score" value=0 placeholder="Financial Score">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Remarks</label>
                                                <textarea type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Status <span style="color:#EF5452">*</span></label>
                                                <select class="form-control" id="status_id" name="status_id" >
                                                    @foreach($all_status as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END Project Create Labels -->
            </div>
        </div>
    </div>
    <!-- End Page Content -->
@endsection

@section('js_after')
    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript">
        $('#submission_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            orientation: "bottom left"
        });
    </script>
@endsection
