@extends('layouts.backend-master')
@section('title', 'SDEMS Equipment Transfer')
@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link href="{{ asset('assets/exportData/css/buttons.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .wmg-content .block-header {
            padding: 5px 20px;
        }

        .wmg-content .content-heading {
            font-size: 14px;
            line-height: 14px;
            margin-bottom: 10px;
        }

        .wmg-content #wmg-table th,
        td {
            font-size: 12px;
        }

        .wmg-content #btn_filter .btn {
            margin-top: 23px;
            margin-right: 20px;
            width: 200px;
            float: right;
        }

        .wmg-content .dataTables_wrapper {
            margin-top: 0;
        }

        .wmg-content .block-title {
            font-size: 16px;
        }
    </style>
@endsection
@section('content')
    <!-- Breadcrumb -->
    <div class="bg-body-light border-b">
        <div class="content py-1 text-center">
            <nav class="breadcrumb bg-body-light mb-1" style="font-size: 14px;">
                <a class="breadcrumb-item" href="{{ url('/dashboard') }}">
                    <i class="fa fa-dashboard"></i> Dashboard
                </a>
                <span class="breadcrumb-item active">CS Dashboard</span>
            </nav>
        </div>
    </div>

    <!-- END Breadcrumb -->
    <!-- Filters -->
    <div class="content wmg-content">
        <div class="block" style="margin-bottom: 0;">
            <div class="block-header block-header-default">
                <h3>CS Dashboard</h3>
                <div class="block-options">
                    <a href="{{ route('admin.cs.create') }}">
                        <button type="button" class="btn btn-info float-right">
                            <i class="fa fa-plus"></i> | New CS
                        </button>
                    </a>
                </div>
            </div>
            <br>
            <div class="content-heading">
                <div class="row" style="margin-right:10px; margin-left:10px;">
                    <div class="col-md-4">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="font-weight-bold mb-1" style="display:block;">Equipments</label>
                            <select class="form-control" id="equipment_id" required
                                style="border:none; border-bottom: 1px solid #ccc; border-radius: 0; box-shadow: none; padding-left: 0;">
                                <option value="">Select One</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->categoryname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="font-weight-bold mb-1" style="display:block;">Status</label>
                            <select class="form-control" id="status_id" required
                                style="border:none; border-bottom: 1px solid #ccc; border-radius: 0; box-shadow: none; padding-left: 0;">
                                <option value="">Select One</option>
                                @foreach ($statues as $item)
                                    <option value="{{ $item->id }}">{{ $item->status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="font-weight-bold mb-1" style="display:block;">To User</label>
                            <select class="form-control" id="to_user_id" required
                                style="border:none; border-bottom: 1px solid #ccc; border-radius: 0; box-shadow: none; padding-left: 0;">
                                <option value="">Select One</option>
                                @foreach ($users as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <a id="btn_filter">
                            <button type="button" class="btn btn-primary">
                                Search
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END Filters -->
    <!-- Page Content -->
    <div class="content" style="padding: 0; margin: 0;">
        <!-- Equipment Transfer Information -->
        <div class="row modify_section" style="margin: 0;">
            <div class="col-md-12" style="padding: 0;">
                <div class="content-heading" style="margin: 0; padding: 0;">
                    Requisitions List
                </div>
                <div class="block block-rounded" style="margin: 0; padding: 0;">
                    <div class="block-content" id="box_content" style="margin: 0; padding: 0;">
                        <table id="tr-table" class="table table-bordered table-striped table-vcenter js-dataTable-full"
                            style="margin: 0; padding: 0;">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>SL</th>
                                    <th>Req Id</th>
                                    <th>Vendor</th>
                                    <th>Category</th>
                                    <th>Subcategory</th>
                                    <th>Technical Specification</th>
                                    <th>CSBy</th>
                                    <th>CS Date</th>
                                    <th>Status</th>
                                    <th>Division</th>
                                    <th>Project</th>
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                    <th>Price(with VAT & IT)</th>
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($csData as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->vendorname }}</td>
                                        <td>{{ $item->categoryname }}</td>
                                        <td>{{ $item->subcategoryname }}</td>
                                        <td>{{ $item->techspecification }}</td>
                                        <td class="text-truncate" style="max-width:20px;">{{ $item->user_name }}</td>
                                        <td class="text-truncate" style="max-width:200px;">
                                            {{ date('Y-m-d', strtotime($item->csdate)) }}</td>
                                        <td class="text-truncate" style="max-width:20px;">{{ $item->status }}</td>
                                        <td class="text-truncate" style="max-width:20px;">{{ $item->divisionname }}</td>
                                        <td class="text-truncate" style="max-width:20px;">{{ $item->projectno }}</td>
                                        <td>{{ $item->unitprice }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->totalprice }}</td>
                                        <td class="text-truncate" style="max-width:100px;">{{ $item->filename }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.requisitions.edit', $item->id) }}"
                                                    class="btn btn-primary btn-flat"><i class="fa fa-edit"></i></a>
                                                &nbsp;&nbsp;&nbsp;
                                                <a href="{{ route('admin.requisitions.show', $item->id) }}"
                                                    class="btn btn-info btn-flat"><i class="fa fa-check-circle"></i></a>

                                                &nbsp;&nbsp;&nbsp;
                                                <a href="{{ route('requisitions.report', $item->id) }}" target="_blank"
                                                    class="btn btn-success btn-flat">
                                                    <i class="fa fa-print"></i>
                                                </a>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Equipment Transfer Information -->
    </div>

    <!-- END Page Content -->
    <!-- Approved Transfer Modal -->
    <div class="modal fade" id="approvedTransfer" tabindex="-1" role="dialog" aria-labelledby="approvedTransfer"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="trApprovedTransferForm" name="trApprovedTransferForm" class="form-horizontal" method="POST"
                enctype="multipart/form-data">
                {{-- <form id="trApprovedTransferForm" name="trApprovedTransferForm" class="form-horizontal" action="{{ route('approved-eqp-transfer') }}" method="POST" enctype="multipart/form-data"> --}}
                {{ csrf_field() }}
                <input type="hidden" id="tr_id" name="tr_id" value="1">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="margin-top:20px;" class="modal-title" id="approvedTransferTitle">Approved Equipment
                            Transfer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="tr_description">Comments <span style="color: #FF0000">*</span></label>
                            <textarea class="form-control" rows="4" cols="50" id="tr_description" name="tr_description"
                                placeholder="Enter Comments Here" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success" value="create">Accept</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END Approved Transfer Modal -->
    <!-- Rejected Transfer Modal -->
    <div class="modal fade" id="rejectedTransfer" tabindex="-1" role="dialog" aria-labelledby="rejectedTransfer"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="trRejectedTransferForm" name="trRejectedTransferForm" class="form-horizontal" method="POST"
                enctype="multipart/form-data">
                {{-- <form id="trRejectedTransferForm" name="trRejectedTransferForm" class="form-horizontal" action="{{ route('rejected-eqp-transfer') }}" method="POST" enctype="multipart/form-data"> --}}
                {{ csrf_field() }}
                <input type="hidden" id="rej_tr_id" name="rej_tr_id" value="1">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="margin-top:20px;" class="modal-title" id="rejectedTransferTitle">Rejected Equipment
                            Transfer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="rej_tr_description">Comments <span style="color: #FF0000">*</span></label>
                            <textarea class="form-control" rows="4" cols="50" id="rej_tr_description" name="rej_tr_description"
                                placeholder="Enter Comments Here" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger" value="create">Rejected</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END Rejected Transfer Modal -->
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.1/chart.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tr-table').DataTable({
                dom: 'Bfrtip',
                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10', '25', '50', 'Show All']
                ],
                buttons: [{
                        extend: 'copy',
                        text: '<i class="fas fa-file-copy fa-1x"> Copy</i>'
                    },
                    {
                        extend: 'csv',
                        text: '<i class="fas fa-file-csv fa-1x"> CSV</i>'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel" aria-hidden="true"> EXCEL</i>'
                    },
                    'pageLength'
                ]
            });
        });

        // Get Data Using Search Filter
        $(function() {
            $('#btn_filter').click(function() {
                if ($('#equipment_id').val() || $('#status_id').val() || $('#to_user_id').val()) {
                    contents = $('#box_content');
                    contents.empty();
                    $.ajax({
                        type: "GET",
                        url: "transfer-list",
                        data: {
                            'equipment_id': $('#equipment_id').val(),
                            'status_id': $('#status_id').val(),
                            'to_user_id': $('#to_user_id').val()
                        },
                        dataType: "html",
                        success: function(data) {
                            contents.html(data);
                        }
                    }).fail(function(error_response) {
                        $('#error_span').text('Please Fill up all required field(s)');
                    });
                } else {
                    alert('Please select all the filter options !');
                }
            });
        });

        function showApprovedTransfer(id) {
            $('#saveApprovedTransfer').val("approved-eqp-transfer");
            $('#tr_id').val(id);
            $('#trApprovedTransferForm').trigger("reset");
            $('#approvedTransfer').modal('show');
        };

        function showRejectedTransfer(id) {
            $('#saveRejectedTransfer').val("rejected-eqp-transfer");
            $('#rej_tr_id').val(id);
            $('#trRejectedTransferForm').trigger("reset");
            $('#rejectedTransfer').modal('show');
        };
    </script>
@endsection
