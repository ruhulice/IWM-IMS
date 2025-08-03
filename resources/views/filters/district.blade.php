<div class="form-group">
    <label class = "col-sm-4 control-label">{{Form::label('district', 'District')}}</label>
    <div class="col-sm-8">
        {{Form::select('district_id', [''=>'All'] + App\Models\District::pluck('name', 'id')->toArray(), null,
        ['class'=>'select2Me form-control', 'id'=>'district_id'])}}
    </div>
</div>
