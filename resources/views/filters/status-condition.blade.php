<div class="form-group">
    <label class = "col-sm-4 control-label">{{Form::label('status_id', 'Status')}}</label>
    <div class="col-sm-8">
        {{Form::select('status_id', $status_condition, null,
        ['class'=>'select2Me form-control', 'id'=>'status_id'])}}
    </div>
</div>