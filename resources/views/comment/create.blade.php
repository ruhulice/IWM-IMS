@extends('layouts.backend-master')
@section('title', 'Create Comment')
@section('content')
    <style>
      .card-body{
        padding: 15px;
      }
    </style>
    <!-- Breadcrumb -->
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center">
            <nav class="breadcrumb bg-body-light mb-0">
                <a class="breadcrumb-item" href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a>
                <a class="breadcrumb-item" href="{{ url('/comments') }}">Comments</a>
                <span class="breadcrumb-item active">New Comment</span>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->
    <!-- Page Content -->
    <div class="content">
      <!-- Comments Create -->
      <div class="row">
          <div class="col-md-12">
              <div class="block">
                <form class="card-body" class="mb-2" action="{{ route('comments.store') }}" method="POST" name="add_Comment">
                  {{ csrf_field() }}
                  <div class="row">
                    <div class="col-md-12">
                      {{-- <div class="form-group">
                        <strong>Comment</strong>
                        <textarea name="cmnt" id="cmnt" class="form-control" style="min-height: 200px" placeholder="Enter Comment"></textarea>
                        <span class="text-danger">{{ $errors->first('cmnt') }}</span>
                      </div> --}}
                      <div class="form-group">
                          <label class="font-weight-bold" for="cmnt">Comment <span style="color:#EF5452">*</span></label>
                          <textarea class="textarea ckeditor" id="cmnt" name="cmnt" required="required" rows="5" style="width:100%;"></textarea>
                          <span class="text-danger">{{ $errors->first('cmnt') }}</span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <strong>Status</strong>
                        {{-- <input type="text" name="status" class="form-control" placeholder="Enter Status"> --}}
                        <select {{Auth::user()->type!=1?'disabled':''}} name="status" class="form-control" placeholder="Enter Status">
                          <option value="Pending">Pending</option>
                          <option value="Working">Working</option>
                          <option value="Completed">Completed</option>
                        </select>
                        @if (Auth::user()->type!=1)
                          <input type="hidden" name="status" value="Pending" />
                        @endif
                        <span class="text-danger">{{ $errors->first('status') }}</span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <strong>Progress</strong>
                        <input {{Auth::user()->type!=1?'readonly':''}} type="number" min="0" max="100" value="0" name="progress"
                          class="form-control" placeholder="Enter Progress">
                        <span class="text-danger">{{ $errors->first('progress') }}</span>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
          </div>
      </div>
  </div>
@endsection
@section('js_after')
    <!-- Editor init -->
    <script src="{{ asset('assets/js/plugins/ckeditor/ckeditor.js') }}"></script>
    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/bootstrap-wizard/jquery.bootstrap.wizard.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('assets/js/pages/be_forms_wizard.min.js') }}"></script>
    <script type="text/javascript">
        CKEDITOR.config.allowedContent = true;
    </script>
@endsection
