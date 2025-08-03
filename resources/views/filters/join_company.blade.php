<div class="form-group">
    <label class = "col-sm-4 control-label">{{Form::label('staff_join_from', 'Staff Join From')}}</label>
    <div class="col-sm-8">
        {{Form::select('staff_join_from_id', ['' => 'All'] + App\Models\StaffJoinFrom::pluck('name', 'id')->toArray(), null,
        ['class'=>'select2Me form-control', 'id'=>'staff_join_from_id'])}}
    </div>
</div>
