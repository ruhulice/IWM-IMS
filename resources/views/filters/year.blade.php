<div class="form-group">
    <label class = "col-sm-4 control-label">{{Form::label('year', 'Year')}} <span style="color:#EF5452">*</span></label>
    <div class="col-sm-8">
        @php
            $pre_year  = date("Y", strtotime("first day of previous month"));
        @endphp
        <select name="year" id="year" class="form-control" required>
            <option value="2020" {{ $pre_year == 2020 ? 'selected' : '' }}>2020</option>
            <option value="2021" {{ $pre_year == 2021 ? 'selected' : '' }}>2021</option>
            <option value="2022" {{ $pre_year == 2022 ? 'selected' : '' }}>2022</option>
            <option value="2023" {{ $pre_year == 2023 ? 'selected' : '' }}>2023</option>
            <option value="2024" {{ $pre_year == 2024 ? 'selected' : '' }}>2024</option>
            <option value="2025" {{ $pre_year == 2025 ? 'selected' : '' }}>2025</option>
        </select>
    </div>
</div>
