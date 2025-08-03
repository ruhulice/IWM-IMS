<div class="form-group">
    <label class = "col-sm-4 control-label">{{Form::label('leave_type', 'Leave Type')}}</label>
    <div class="col-sm-8">
        {{Form::select('leave_type_id',[''=>'All']+App\Models\LeaveType::where('status_id', 1)->orderBy('id', 'asc')->pluck('name', 'id')->toArray(), null,
        ['class'=>'select2Me form-control', 'id'=>'leave_type_id'])}}
    </div>
</div>
