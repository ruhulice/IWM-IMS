<div class="form-group">
    <label class = "col-sm-4 control-label">{{Form::label('employee_id', 'Employee Name')}}</label>
    <div class="col-sm-8">
        {{Form::select('employee_id', [''=>'All'] + App\Models\Employee::pluck('name', 'id')->toArray(), null,
        ['class'=>'select2Me form-control', 'id'=>'employee_id'])}}
    </div>
</div>
