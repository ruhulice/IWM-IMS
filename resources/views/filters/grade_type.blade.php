<div class="form-group">
    <label class = "col-sm-4 control-label">{{Form::label('grade_type', 'Grade Type')}}</label>
    <div class="col-sm-8">
        {{Form::select('grade_type_id', ['' => 'All'] + App\Models\GradeType::pluck('name', 'id')->toArray(), null,
        ['class'=>'select2Me form-control', 'id'=>'grade_type_id'])}}
    </div>
</div>
