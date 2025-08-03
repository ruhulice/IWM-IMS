@extends('layouts.backend-master')

@section('title', 'Feedback Management')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <style>
        #feedback-table th, #feedback-table td {
            font-size: 12px !important;
        }
        #feedback-table .red {
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
                <span class="breadcrumb-item">Feedback Management</span>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <!-- Menus -->
        <div class="content-heading">
            <div class="dropdown float-right"></div>
            Feedback List ({{ count($feedbacks) }})
        </div>
        <div class="block block-rounded">
            <div class="block-content" id="box_content">
                <!-- Menus Table -->
                <table id="feedback-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Plot</th>
                            <th class="text-center">Division/District/Upazilla</th>
                            {{--<th>District</th>
                            <th>Upazilla</th>--}}
                            <th class="text-center">Mouza Code</th>
                            <th class="text-center">Given by</th>
                            {{--<th class="text-center">Feedback</th>--}}
                            <th class="text-center">Status</th>
                            <th class="text-center">Details</th>
                            {{--<th>Remarks</th>--}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feedbacks as $key=>$feedback)
                            <tr>
                                <td class="text-center">{{ $key+1 }}</td>
                                <td class="red text-center">
                                    <span class="badge badge-info">{{ $feedback->plot_no }}</span>
                                </td>
                                <td class="text-center">{{ $feedback->division }}/{{ $feedback->district }}/{{ $feedback->upazilla }}</td>
                                {{--<td>{{ $feedback->district }}</td>--}}
                                {{--<td>{{ $feedback->upazilla }}</td>--}}
                                <td class="text-center">{{ $feedback->mouza_code }}</td>
                                <td class="text-center">
                                    @if($feedback->createdBy)
                                        {{ $feedback->createdBy->name }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($feedback->is_resolved == true)
                                        <span class="badge badge-success">RESOLVED</span>
                                    @else
                                        <span class="badge badge-danger">PENDING</span>
                                    @endif
                                </td>
                                {{--<td class="text-center"><span class="badge badge-danger">{{ $feedback->land_use_feedback }}</span></td>--}}
                                <td class="text-center">
                                    <a href="{{ url('feedback/'.$feedback->id.'/show') }}" type="button" class="btn btn-success btn-sm">Show Details</a>
                                </td>
                                {{--<td>{{ $feedback->feedback_remarks }}</td>--}}

                                {{--<td class="text-center">--}}
                                    {{--@if($feedback->is_seen == true)--}}
                                        {{--<span class="badge badge-success">Seen</span>--}}
                                    {{--@else--}}
                                        {{--<span class="badge badge-danger">No Seen</span>--}}
                                    {{--@endif--}}
                                {{--</td>--}}
                                {{--<td>
                                    <div class="btn-group">
                                        <a href="{{ route('feedbacks.edit',$feedback->id) }}" class="btn btn-warning btn-flat"><i class="fa fa-edit"></i></a>
                                    </div>
                                </td>--}}
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Plot</th>
                            <th class="text-center">Division/District/Upazilla</th>
                            {{--<th>District</th>
                            <th>Upazilla</th>--}}
                            <th class="text-center">Mouza Code</th>
                            {{--<th class="text-center">Given by</th>--}}
                            <th class="text-center">Feedback</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Details</th>
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
            $('#feedback-table').DataTable();
        });
    </script>
@endsection
