<div class="form-group" id="date_input">
    <label class = "col-sm-4 control-label">
        {{Form::label('date_range', 'Date Range')}}
    </label>
    <div class="col-sm-8 input-group date input-daterange">
        <span class="input-group-addon"><i class="fa fa-calendar"></i>&nbsp;From</span>
        {{Form::text('from_date', null, ['placeholder'=>'','class' => "form-control", 'id'=>'from_date'])}}
        <span class="input-group-addon"><i class="fa fa-calendar"></i>&nbsp;To</span>
        {{Form::text('to_date', null, ['placeholder'=>'','class' => "form-control", 'id'=>'to_date'])}}
    </div>
</div>