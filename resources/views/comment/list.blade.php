@extends('layouts.backend-master')
@section('title', 'Comment List')
@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <style>
        .show-ref {
            cursor: pointer;
            color: darkslateblue !important;
            float: right;
        }
    </style>
@endsection
@section('content')
    <!-- Breadcrumb -->
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center">
            <nav class="breadcrumb bg-body-light mb-0">
                <a class="breadcrumb-item" href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a>
                <span class="breadcrumb-item">Comments Manager</span>
                <span class="breadcrumb-item active">Comments List</span>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->
    <!-- Page Content -->
    <div class="content">
        <!-- Comments -->
        <div class="content-heading">
            <div class="dropdown float-left">Comments List </div>
            <a href="{{ route('comments.create') }}">
                <button type="button" class="btn btn-info float-right">
                    <i class="fa fa-plus"></i> | Add New Comment
                </button>
            </a>
            &nbsp;&nbsp;            
        </div>
        @if ($message = Session::get('success'))
          <div class="col-3 mx-auto alert alert-success">
              {!! $message !!}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
        @endif
        @if ($message = Session::get('error'))
          <div class="col-3 mx-auto alert alert-danger">
              {!! $message !!}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
        @endif
        <div class="block block-rounded">
            <div class="block-content" id="box_content">
                <!-- Comments Table -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="comment_table">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th width="40%">Comments</th>
                        <th width="5%">Status</th>
                        {{--<th width="5%">Progress</th>--}}
                        <th width="20%">Commented By</th>
                        <th width="20%">Time</th>
                        <th width="15%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $key=>$item)
                        <tr>
                          <td>{{ $key+1 }}</td>
                          <td>
                              <span>{!! substr($item->cmnt, 0, 80) !!}</span>
                              <a href="{{ route('comments.show',$item->id)}}" class="show-ref">&nbsp;&nbsp; show more...</a>

                              {{--<details>
                                <summary>
                                  {!! substr($item->cmnt, 0, 100) !!}
                                </summary>
                                <p>{!! $item->cmnt !!}</p>
                              </details>--}}
                          </td>
                          <td>{!! $item->status !!}</td>
                          {{--<td>{{ $item->progress }}</td>--}}
                          <td>{{ $item->user->name }}</td>
                          <td>{{ date_format($item->updated_at, 'Y-m-d h:ia') }}</td>
                          <td class="px-2">
                            <a href="{{ route('comments.show',$item->id)}}" class="btn btn-sm btn-success">Show</a>
                            <a href="{{ route('comments.edit',$item->id)}}" class="btn btn-sm btn-primary">Edit</a>
                            {{-- <form onsubmit="return confirm('Do you really want to delete?');" action="{{ route('comments.destroy', $item->id)}}" method="post">
                              {{ csrf_field() }}
                              @method('DELETE')
                              <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                            </form> --}}
                          </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- END Comments Table -->
            </div>
        </div>
        <!-- END Comments -->
    </div>
    <!-- END Page Content -->

@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $('#comment_table').DataTable();
        });
    </script>
@endsection
