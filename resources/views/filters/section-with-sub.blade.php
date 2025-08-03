<div class="form-group">
    <label class = "col-sm-4 control-label">{{Form::label('section', 'Section')}}</label>
    <div class="col-sm-8">
        {{Form::select('section_id', ['' => 'All'] + App\Models\Section::pluck('name', 'id')->toArray(), null,
        ['class'=>'select2Me form-control', 'id'=>'section_id', 'onchange'=>'getSubSectionBySectionId()'])}}
    </div>
</div>
