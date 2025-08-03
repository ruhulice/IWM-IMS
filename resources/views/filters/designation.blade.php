<div class="form-group">
    <label class = "col-sm-4 control-label">{{Form::label('designation', 'Designation')}}</label>
    <div class="col-sm-8">
        {{Form::select('designation_id', [''=>'All'] + App\Models\Designation::pluck('name', 'id')->toArray(), null,
        ['class'=>'select2Me form-control', 'id'=>'designation_id'])}}
    </div>
</div>
