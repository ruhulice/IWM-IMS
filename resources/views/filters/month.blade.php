<div class="form-group">
    <label class = "col-sm-4 control-label">{{Form::label('month', 'Month')}} <span style="color:#EF5452">*</span></label>
    <div class="col-sm-8">
        {{--<select class="form-control" id="month" name="month" required>
            <?php
            /*for ($i = 0; $i < 12; $i++) {
                $time = strtotime(sprintf('%d months', $i));
                $label = date('F', $time);
                $value = date('n', $time);
                echo "<option value='$value'>$label</option>";
            }*/
            ?>
        </select>--}}
        {{--@php
            $all_months = App\Http\Controllers\ExportToExcelController::months();
            echo $all_months;
        @endphp--}}
        @php
            $pre_month = date("m", strtotime("first day of previous month"));
        @endphp
        <select class="form-control" id="month" name="month" size="1" required>
            <option value="1" {{ $pre_month == 1 ? 'selected' : '' }}>January</option>
            <option value="2" {{ $pre_month == 2 ? 'selected' : '' }}>February</option>
            <option value="3" {{ $pre_month == 3 ? 'selected' : '' }}>March</option>
            <option value="4" {{ $pre_month == 4 ? 'selected' : '' }}>April</option>
            <option value="5" {{ $pre_month == 5 ? 'selected' : '' }}>May</option>
            <option value="6" {{ $pre_month == 6 ? 'selected' : '' }}>June</option>
            <option value="7" {{ $pre_month == 7 ? 'selected' : '' }}>July</option>
            <option value="8" {{ $pre_month == 8 ? 'selected' : '' }}>August</option>
            <option value="9" {{ $pre_month == 9 ? 'selected' : '' }}>September</option>
            <option value="10" {{ $pre_month == 10 ? 'selected' : '' }}>October</option>
            <option value="11" {{ $pre_month == 11 ? 'selected' : '' }}>November</option>
            <option value="12" {{ $pre_month == 12 ? 'selected' : '' }}>December</option>
        </select>
    </div>
</div>
