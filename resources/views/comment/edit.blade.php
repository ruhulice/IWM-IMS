@extends('layouts.backend-master')
@section('title', 'Comment Edit')
@section('content')
<!-- Breadcrumb -->
<div class="bg-body-light border-b">
    <div class="content py-5 text-center">
        <nav class="breadcrumb bg-body-light mb-0">
            <a class="breadcrumb-item" href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
            <span class="breadcrumb-item">Comments Manager</span>
            <a class="breadcrumb-item" href="{{ route('comments.index') }}"> Comments</a>
            <span class="breadcrumb-item active">Edit Comment</span>
        </nav>
    </div>
</div>
<!-- END Breadcrumb -->
<!-- Page Content -->
<div class="content">
    <!-- Comments Edit -->
    <div class="row">
        <div class="col-md-12">
            <!-- Comments Edit Labels -->
            <div class="block">
                <form action="{{ route('comments.update', $id) }}" method="POST" enctype="multipart/form-data" role="form">
                    @csrf
                    @method('PUT')
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Edit Comment</h3>
                        <div class="block-options">
                            <a type="button" class="btn btn-danger" href="{{ route('comments.index') }}">Back</a>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-md-9">
                              {{-- <div class="form-group">
                                <strong>Comment</strong>
                                <textarea type="text" id="cmnt" name="cmnt" class="form-control" rows="8" cols="50">{!!$cmnt!!}</textarea>
                                <span class="text-danger">{{ $errors->first('cmnt') }}</span>
                              </div> --}}
                              <div class="form-group">
                                  <label class="font-weight-bold" for="cmnt">Comment <span style="color:#EF5452">*</span></label>
                                  <textarea class="textarea ckeditor" id="cmnt" name="cmnt" required="required" rows="5" style="width:100%;">{!!$cmnt!!}</textarea>
                                  <span class="text-danger">{{ $errors->first('cmnt') }}</span>
                              </div>
                            </div>
                            <div class="col-md-9">
                              <div class="form-group">
                                <strong>Status</strong>
                                {{-- <input type="text" name="status" class="form-control" placeholder="Enter Status" value="{!!$status!!}"> --}}
                                <select  {{Auth::user()->type!=1?'disabled':''}} name="status" class="form-control" placeholder="Enter Status">
                                  <option value="Pending" {{$status=='Pending' ? 'selected': null}}>Pending</option>
                                  <option value="Working" {{$status=='Working' ? 'selected': null}}>Working</option>
                                  <option value="Completed" {{$status=='Completed' ? 'selected': null}}>Completed</option>
                                </select>
                                <span class="text-danger">{{ $errors->first('status') }}</span>
                              </div>
                            </div>
                            <div class="col-md-9">
                              <div class="form-group">
                                <strong>Progress</strong>
                                <input  {{Auth::user()->type!=1?'readonly':''}} required="required" type="number" min="0" max="100" name="progress" class="form-control" placeholder="Enter Progress" value="{{$progress}}">
                                <span class="text-danger">{{ $errors->first('progress') }}</span>
                              </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END Comments Edit Labels -->
        </div>
    </div>
    <!-- END Comments Edit -->
</div>
<!-- END Page Content -->
@endsection
@section('js_after')
    <!-- Editor init -->
    <script src="{{ asset('assets/js/plugins/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        CKEDITOR.config.allowedContent = true;
    </script>
@endsection
