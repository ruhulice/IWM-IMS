@extends('layouts.backend-master')
@section('title', 'User List')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
    <!-- Breadcrumb -->
    <div class="bg-body-light border-b">
        <div class="content py-1 text-center">
            <nav class="breadcrumb bg-body-light mb-0">
                <a class="breadcrumb-item" href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a>
                <span class="breadcrumb-item">Dashboard</span>
                <span class="breadcrumb-item active">Central ICT Budget</span>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <a href="{{ route('admin.ictbudgets.create') }}" class="btn btn-info float-right pt-2">
            <i class="fa fa-plus"></i> Add New
        </a>
    </div>


    <div class="block block-rounded">
        <div class="block-content" id="box_content">
            <!-- Users Table -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="user_table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Particulars</th>
                        <th>Financial Year</th>
                        <th>Unit</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($centralbudget as $key => $budget)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $budget->particulars }}</td>
                            <td>{{ $budget->fy }}</td>
                            <td>{{ $budget->unit }}</td>
                            <td>{{ $budget->unitprice }}</td>
                            <td>{{ $budget->quantity }}</td>
                            <td>{{ $budget->subtotalprice }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- END Users Table -->
        </div>
    </div>
    <!-- END Users -->
    </div>
    <!-- END Page Content -->
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    {{-- <script type="text/javascript">
        $(function() {
            $('#user_table').DataTable();
        });

        $(document).ready(function() {
            FilterData();
        });

        function FilterData() {
            $ftype = $('#filter_type').val();
            if ($ftype == 'all') {
                $("#all").show();
                $("#active").hide();
                $("#inactive").hide();
            } else if ($ftype == 'active') {
                $("#active").show();
                $("#all").hide();
                $("#inactive").hide();
            } else if ($ftype == 'inactive') {
                $("#inactive").show();
                $("#all").hide();
                $("#active").hide();
            }

            contents = $('#box_content');
            contents.empty();
            $.ajax({
                type: "get",
                url: "FilteredUserData",
                data: {
                    'filter_type': $ftype
                },
                dataType: "html",
                success: function(data) {
                    contents.html(data);
                }
            }).fail(function(error_response) {
                $('#error_span').text('Please fill up all required field(s).');
            });
        }

        function UserSwitchButton(rowId) {
            var user_id = rowId;
            var checkStatus = $('#togBtn' + rowId).val();
            $(".switch-publish-loader-" + rowId).empty();
            $(".switch-publish-loader-" + rowId).append('<i class="fa fa-spinner"></i>');
            $.ajax({
                type: "get",
                url: "UserSwitchUpdate",
                data: {
                    user_id: user_id,
                    checkStatus: checkStatus
                },
                dataType: "json",
                success: function(response) {
                    $('#togBtn' + rowId).val(response);
                    $(".switch-publish-loader-" + rowId).empty();
                    $(".switch-publish-loader-" + rowId).append('<i class="fa fa-check succ-msg"></i>');
                },
                error: function() {
                    alert("Some error occurred. Please try again later.")
                }
            });
        }
    </script> --}}
@endsection
