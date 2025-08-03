@extends('layouts.backend-master')

@section('title', 'Feedback Management')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <style>
        #feedback-table th, #feedback-table td {
            font-size: 12px !important;
        }
        .red {
            color: red;
        }
    </style>
@endsection

@section('content')

    <!-- Breadcrumb -->
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center">
            <nav class="breadcrumb bg-body-light mb-0">
                <a class="breadcrumb-item" href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
                <a class="breadcrumb-item" href="{{ url('/feedback-list') }}"> Feedback Management</a>
                <span class="breadcrumb-item">Feedback Details</span>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content" id="box_content">
                <form action="{{ route('feedback.resolve',$feedback->id) }}" method="POST" enctype="multipart/form-data" role="form" id="feedbackForm">
                    @csrf
                    @method('PUT')
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th width="25%">Plot No</th>
                                <th width="75%">
                                    <span class="badge badge-danger">{{ $feedback->plot_no }}</span>
                                </th>
                            </tr>
                            <tr>
                                <th width="25%">Division</th>
                                <th width="75%">
                                    {{ $feedback->division }}
                                </th>
                            </tr>
                            <tr>
                                <th width="25%">District</th>
                                <th width="75%">
                                    {{ $feedback->district }}
                                </th>
                            </tr>
                            <tr>
                                <th width="25%">Upazilla</th>
                                <th width="75%">
                                    {{ $feedback->upazilla }}
                                </th>
                            </tr>
                            <tr>
                                <th width="25%">Mouza Code</th>
                                <th width="75%">
                                    {{ $feedback->mouza_code }}
                                </th>
                            </tr>
                            <tr>
                                <th width="25%">Current Landuse</th>
                                <th width="75%">
                                    {{ $feedback->orginal_land_use }}
                                </th>
                            </tr>
                            <tr>
                                <th width="25%">Landuse Feedback</th>
                                <th width="75%">
                                    {{ $feedback->land_use_feedback }}
                                </th>
                            </tr>
                            <tr>
                                <th width="25%">Uploaded Image</th>
                                <td width="75%">
                                    @if(!empty($feedback->image_feedback))
                                        <img src="{{ url($feedback->image_feedback) }}" alt="" style="width: 200px; height: auto;">
                                    @else
                                        <span class="badge badge-danger">No Image Uploaded</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th width="25%">Given by</th>
                                <th width="75%">
                                    @if($feedback->createdBy)
                                        {{ $feedback->createdBy->name }}
                                    @endif
                                </th>
                            </tr>
                            <tr>
                                <th width="25%">Written Feedback/Remarks</th>
                                <th width="75%">{{ $feedback->feedback_remarks }}</th>
                            </tr>
                            <tr>
                                <th class="red" width="25%">Admin Comments *</th>
                                <th width="75%">
                                    @if($feedback->is_resolved == true)
                                        {{ $feedback->admin_comments }}
                                    @else
                                        <textarea class="form-control" name="admin_comments" required></textarea>
                                    @endif
                                </th>
                            </tr>

                            @if($feedback->is_resolved == true)
                                <tr>
                                    <th class="red" width="25%">Status</th>
                                    <th width="75%">
                                        <span class="badge badge-success">RESOLVED</span>
                                    </th>
                                </tr>
                            @else
                                <input type="hidden" name="feedback_id" value="{{ $feedback->id }}">
                                <input type="hidden" name="plot_no" value="{{ $feedback->plot_no }}">
                                <input type="hidden" name="to_user" value="{{ $feedback->created_by }}">
                            @endif
                        </table>

                        @if($feedback->is_resolved == false)
                            <div class="pull-right">
                                <a href="javascript:void(0);" onclick="submitFunction()" class="btn btn-lg btn-danger" type="submit">
                                    Feedback Resolved
                                </a>
                            </div>
                        @else
                            <div class="pull-right">
                                <a href="{{ url('/feedback-list') }}" class="btn btn-lg btn-danger" type="submit">
                                    Back
                                </a>
                            </div>
                        @endif

                        <br><br><br>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Menus -->
    </div>
    <!-- END Page Content -->

@endsection

@section('js_after')
    <script>
        function submitFunction() {
            if(confirm('Are you sure you want to submit?')) {
                document.getElementById("feedbackForm").submit();
                Swal.fire(
                    'Your Feedback is successfully submitted. Thank you for your response.',
                    '',
                    'success'
                );
                /*.then(function() {
                    document.getElementById("feedbackForm").submit();
                });*/
            }
        }
    </script>
@endsection
