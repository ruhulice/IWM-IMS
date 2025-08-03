<div class="form-group">
    <label class = "col-sm-4 control-label">{{Form::label('division', 'Division')}}</label>
    <div class="col-sm-8">
        {{Form::select('division_id', [''=>'All'] + App\Models\Division::pluck('name', 'id')->toArray(), null,
        ['class'=>'select2Me form-control', 'id'=>'division_id'])}}
    </div>
</div>
