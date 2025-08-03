<div class="form-group" id="date_input">
    <label class = "col-sm-4 control-label">
        {{Form::label('only_date', 'Select Date')}}
    </label>

    <div class="col-sm-7 input-group date">
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        {{Form::text('only_date', date("Y-m-d"), ['placeholder'=>'Date','class' => "form-control", 'id'=>'only_date'])}}
    </div>
</div>