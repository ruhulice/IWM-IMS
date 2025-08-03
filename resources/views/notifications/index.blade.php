@extends('layouts.backend-master')

@section('title', 'Notifications')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <style>
        #notification-table th, #notification-table td {
            font-size: 13.5px !important;
        }
    </style>
@endsection

@section('content')

    <!-- Breadcrumb -->
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center">
            <nav class="breadcrumb bg-body-light mb-0">
                <a class="breadcrumb-item" href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
                <span class="breadcrumb-item">Notifications</span>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <!-- Menus -->
        <div class="content-heading">
            <div class="dropdown float-right"></div>
            Notification List ({{ count($notifications) }})
        </div>
        <div class="block block-rounded">
            <div class="block-content" id="box_content">
                <!-- Menus Table -->
                <table id="notification-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">#</th>
                            <th width="25%">Title</th>
                            <th width="35%">Details</th>
                            {{--<th width="10%">Action</th>--}}
                            <th width="15%">Seen Time</th>
                            <th class="text-center" width="10%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notifications as $key=>$notification)
                            <tr>
                                <td class="text-center">{{ $key+1 }}</td>
                                <td>{{ $notification->notification_title }}</td>
                                <td>{{ $notification->notification_details }}</td>
                                {{--<td>{{ $notification->action }}</td>--}}
                                <td>{{ $notification->seen_time }}</td>
                                <td class="text-center">
                                    @if($notification->is_seen == true)
                                        <span class="badge badge-success">Seen</span>
                                    @else
                                        <span class="badge badge-danger">No Seen</span>
                                    @endif
                                </td>
                                {{--<td>
                                    <div class="btn-group">
                                        <a href="{{ route('notifications.edit',$notification->id) }}" class="btn btn-warning btn-flat"><i class="fa fa-edit"></i></a>
                                    </div>
                                </td>--}}
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Title</th>
                            <th>Details</th>
                            {{--<th>Action</th>--}}
                            <th>Seen Time</th>
                            <th class="text-center">Status</th>
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
            $('#notification-table').DataTable();
        });
    </script>
@endsection
