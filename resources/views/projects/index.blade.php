@extends('layouts.backend-master')

@section('title', 'Project List')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link href="{{ asset('assets/exportData/css/buttons.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <!-- Breadcrumb -->
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center">
            <nav class="breadcrumb bg-body-light mb-0">
                <a class="breadcrumb-item" href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
                <span class="breadcrumb-item">ICT Projects</span>
                <span class="breadcrumb-item active">Project List ({{ count($results) }})</span>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->

    <!-- Filters -->
    <div class="content">
        <div class="block">
            <div class="block-header block-header-default" >
                {{-- <h3 class="block-title" style="color:#FFFFFF">Filters</h3> --}}
                <div class="block-options">
                    <a href="{{ route('admin.projects.create') }}">
                        <button type="button" class="btn btn-secondary float-right">
                            <i class="fa fa-plus"></i> | Create New
                        </button>
                    </a>
                    {{-- <a href="javascript:void(0)">
                        <button class="btn btn-primary float-right mr-5" data-remote="false" data-toggle="modal" data-target="#myModal" onclick="getSortData()"><i class="fa fa-list"></i> | Sort</button>
                    </a>
                    &nbsp;
                    &nbsp; --}}
                </div>
            </div>
        </div>
    </div>
    <!-- END Filters -->

    <!-- Extra Large Modal -->
    <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="cat_sort_data">
                    <div class="block block-themed block-transparent mb-0 pb-2">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Hierarchy Setup</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content content_sortable" id="modal_box_content">
                            <div id="content_hrcht"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary sort_submit_btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Extra Large Modal -->

    <!-- Page Content -->
    <div class="content">
        <!-- Project List -->
        <div class="block block-rounded">
            <div class="block-content" id="box_content">
                <!-- Project List Table -->
                <table class="table table-responsive table-bordered table-striped table-hover js-dataTable-full" id="pro_table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Client</th>
                            <th>Project No</th>
                            <th>Project Title</th>
                            <th>PL</th>
                            <th>PS</th>
                            <th>Type of Submission</th>
                            <th>Budget(BDT)</th>
                            <th>Association</th>
                            <th>Partner JV Share</th>
                            {{-- Marks Obtained (in proposal) --}}
                            <th>Date Of Submission</th>
                            <th>Technical Score</th>
                            <th>Financial Score</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <!-- <th>Last Update Info</th>
                            <th>Id</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($results as $key=>$item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->client_name }}</td>
                                <td>{{ $item->project_no }}</td>
                                <td>
                                    <a class="font-w600" href="{{ route('admin.projects.edit',$item->id) }}">{{ $item->title }}</a>
                                </td>
                                <td>{{ $item->assign_pl_name }}</td>
                                <td>{{ $item->assign_ps_name }}</td>
                                <td>{{ $item->submission_type_name }}</td>
                                <td>{{ $item->budget }}</td>
                                <td>{{ $item->association }}</td>
                                <td>{{ $item->partner_jv_share }}</td>
                                <td>{{ $item->submission_date }}</td>
                                <td>{{ $item->tech_score }}</td>
                                <td>{{ $item->fin_score }}</td>
                                <!-- <td>
                                    <label class="css-control css-control-success css-switch">
                                        <input class="css-control-input" onclick="ProSwitchButton({{ $item->id }})" type="checkbox" data-switchery {{ $item->status ? 'checked' : ''}} id="togBtn{{ $item->id }}" value="{{ $item->status }}">
                                        <span class="css-control-indicator"></span>
                                    </label>
                                    <div class="pull-right switch-publish-loader-{{ $item->id }}"></div>
                                </td> -->
                                <td>{{ $item->statusName->name }}</td>
                                <td>{{ $item->remarks }}</td>
                                <!-- <td>
                                    {{ date('d M Y, h:i:s a', strtotime($item->updated_at)) }}
                                    <div>Updated by : {{ $item->updatedUser->name }}</div>
                                </td>
                                <td class="text-right">{{ $item->id }}</td> -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- END Project List Table -->
            </div>
        </div>
        <!-- END Project List -->
    </div>
    <!-- END Page Content -->

@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-ui/jquery-ui.js') }}"></script>

    <script src="{{ asset('assets/exportData/js/dataTables.buttons.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/exportData/js/jszip.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/exportData/js/pdfmake.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/exportData/js/vfs_fonts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/exportData/js/buttons.html5.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/exportData/js/buttons.print.min.js') }}" type="text/javascript"></script>
    <script>
        // $(function() {
        //     $('#pro_table').DataTable();
        // });

        $(document).ready(function() {
            $('#pro_table').DataTable( {
                dom: 'Bfrtip',
                lengthMenu: [
                    [ 10, 25, 50, -1 ],
                    [ '10', '25', '50', 'Show All' ]
                ],
                buttons: [
                    { extend: 'copy', text: '<i class="fas fa-file-copy fa-1x"> Copy</i>'},
                    { extend: 'csv', text: '<i class="fas fa-file-csv fa-1x"> CSV</i>'},
                    { extend: 'excel', text: '<i class="fas fa-file-excel" aria-hidden="true"> EXCEL</i>' },
                    { extend: 'pdf', text: '<i class="fas fa-file-pdf fa-1x" aria-hidden="true"> PDF</i>' },
                    'pageLength'
                ]
            });
        });

        function ProSwitchButton(rowId){
            var pro_id      = rowId;
            var checkStatus = $('#togBtn'+ rowId).val();
            $(".switch-publish-loader-" + rowId).empty();
            $(".switch-publish-loader-" + rowId).append('<i class="fa fa-spinner"></i>');
            $.ajax({
                type   : "get",
                url    : "ProSwitchUpdate",
                data   : {
                    pro_id: pro_id,
                    checkStatus: checkStatus
                },
                dataType: "json",
                success: function (response) {
                    $('#togBtn' + rowId).empty();
                    $('#togBtn' + rowId).val(response);
                    $(".switch-publish-loader-" + rowId).empty();
                    $(".switch-publish-loader-" + rowId).append('<i class="fa fa-check succ-msg"></i>');
                },
                error  : function () {
                    alert("Some Error Occurred.Please Try Again Later.")
                }
            });
        }
    </script>
@endsection
