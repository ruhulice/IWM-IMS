@extends('layouts.backend-master')
@section('title', 'Comment Show')
@section('content')
<!-- Breadcrumb -->
<div class="bg-body-light border-b">
    <div class="content py-5 text-center">
        <nav class="breadcrumb bg-body-light mb-0">
            <a class="breadcrumb-item" href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
            <span class="breadcrumb-item">Comments Manager</span>
            <a class="breadcrumb-item" href="{{ route('comments.index') }}"> Comments</a>
            <span class="breadcrumb-item active">Show Comment</span>
        </nav>
    </div>
</div>
<!-- END Breadcrumb -->
<!-- Page Content -->
<div class="content">
    <!-- Comments Show -->
    <div class="row">
        <div class="col-md-12">
            <!-- Comments Show Labels -->
            <div class="block">
                <form action="#" method="POST" role="form">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Show Comment</h3>
                        <div class="block-options">
                            <a type="button" class="btn btn-danger" href="{{ route('comments.index') }}">Back</a>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-md-9">
                              <div class="form-group">
                                <strong>Comment</strong>
                                <textarea type="text" id="cmnt" name="cmnt" class="form-control" rows="8" cols="50" disabled>{!! strip_tags($cmnt) !!}</textarea>
                                <span class="text-danger">{{ $errors->first('cmnt') }}</span>
                              </div>
                            </div>
                            <div class="col-md-9">
                              <div class="form-group">
                                <strong>Status</strong>
                                <input type="text" name="status" class="form-control" placeholder="Enter Status" value="{!!$status!!}" readonly>
                                <span class="text-danger">{{ $errors->first('status') }}</span>
                              </div>
                            </div>
                            <div class="col-md-9">
                              <div class="form-group">
                                <strong>Progress</strong>
                                <input type="number" min="0" max="100" name="progress" class="form-control" value="{{$progress}}" readonly>
                                <span class="text-danger">{{ $errors->first('progress') }}</span>
                              </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END Comments Show Labels -->
        </div>
    </div>
    <!-- END Comments Show -->
</div>
<!-- END Page Content -->
@endsection
