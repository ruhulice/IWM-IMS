<div class="form-group">
    <label class = "col-sm-4 control-label">{{Form::label('section_type', 'Section Type')}}</label>
    <div class="col-sm-8">
        {{Form::select('section_type_id', ['' => 'All'] + App\Models\SectionType::pluck('name', 'id')->toArray(), null,
        ['class'=>'select2Me form-control', 'id'=>'section_type_id'])}}
    </div>
</div>
