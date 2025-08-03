<div class="form-group">
    <label class = "col-sm-4 control-label">{{Form::label('sub_section_id', 'Sub Section')}}</label>
    <div class="col-sm-8">
        {{Form::select('sub_section_id', ['' => 'All'] + App\Models\SubSection::pluck('name', 'id')->toArray(), null,
        ['class'=>'select2Me form-control', 'id'=>'sub_section_id'])}}
    </div>
</div>
