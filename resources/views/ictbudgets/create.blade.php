@extends('layouts.backend-master')
@section('title', 'SDEMS Equipment Transfer Create')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" />
@endsection

@section('content')
    <div class="bg-body-light border-b">
        <div class="content py-1 text-center">
            <nav class="breadcrumb bg-body-light mb-1" style="font-size: 14px;">
                <a class="breadcrumb-item" href="{{ url('/dashboard') }}">
                    <i class="fa fa-dashboard"></i> Dashboard
                </a>
                <span class="breadcrumb-item active">ICT Central Budget</span>
            </nav>
        </div>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="block modify_section">
                    <form action="{{ route('admin.ictbudgets.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="block-header block-header-default">
                            <h2 class="block-title">CS Creation</h2>
                            <div class="block-options">
                                <a class="btn btn-danger" href="{{ route('admin.ictbudgets.index') }}">Back</a>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>

                        <div class="block-content">
                            <div class="row modify_section">
                                <div class="col-md-12">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">CS Date <span
                                                        style="color: red">*</span></label>
                                                <input type="date" class="form-control" id="bdate" name="bdate"
                                                    value="{{ date('Y-m-d') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Financial year <span
                                                        style="color: red">*</span></label>
                                                <input type="text" class="form-control" id="fy" name="fy"
                                                    readonly required>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Purpose of CS <span
                                                        style="color: red">*</span></label>
                                                <textarea class="form-control" id="reqpurpose" name="reqpurpose" rows="3" required>{{ old('reqpurpose') }}</textarea>
                                            </div>
                                        </div>
                                    </div> --}}

                                </div>
                            </div>

                            <div class="row modify_section">
                                <div class="col-md-12 d-flex justify-content-between align-items-center">
                                    <h5>Items List</h5>
                                    <button id="addRow" type="button" class="btn btn-sm btn-success">Add New +</button>
                                </div>

                                <div class="col-md-12">
                                    <table id="MemTable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Category <span style="color: red">*</span></th>
                                                <th>Sub Category <span style="color: red">*</span></th>
                                                <th>Particulars <span style="color: red">*</span></th>
                                                <th>Unit Price <span style="color: red">*</span></th>
                                                <th>Quantity <span style="color: red">*</span></th>
                                                <th>Total Price <span style="color: red">*</span></th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="Metable"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js_after')
    <script src="{{ asset('assets/js/plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script>
        $(document).ready(function() {
            // ✅ Datepicker initialization for bdate
            $('#bdate').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                orientation: "bottom left"
            }).on('changeDate', function() {
                $('#fy').val(getFinancialYear());
            });

            // ✅ Set FY on page load
            $('#fy').val(getFinancialYear());

            // ✅ Function to get Financial Year
            function getFinancialYear() {
                const dateInput = $('#bdate').val();
                if (!dateInput) return "";
                const date = new Date(dateInput);
                const month = date.getMonth() + 1;
                const year = date.getFullYear();
                return month >= 7 ? `${year}-${year + 1}` : `${year - 1}-${year}`;
            }

            // ✅ Add Row dynamically
            let count_row = parseInt(findTableMaxRowId('#Metable'));
            $('#addRow').click(function() {
                count_row++;
                $('#Metable').append(`
            <tr data-rowid="${count_row}">
                <td>
                    <select class="form-control category-select" name="categoryid[]" required>
                        <option value="">Select One</option>
                        @foreach ($category as $item)
                            <option value="{{ $item->id }}">{{ $item->categoryname }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select class="form-control subcategory-select" name="subcategoryid[]" required>
                        <option value="">Select One</option>
                    </select>
                </td>
                <td><input type="text" class="form-control" name="particulars[]" placeholder="Enter techspecification" required></td>
                <td><input type="number" class="form-control rate-input" name="unitprice[]" value="1" min="0" required></td>
                <td><input type="number" class="form-control quantity-input" name="quantity[]" value="1" min="0" required></td>
                <td><input type="number" class="form-control price-input" name="subtotalprice[]" value="1" readonly></td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btnDeleteMem"><i class="fa fa-times"></i></button>
                </td>
            </tr>
        `);
            });

            // ✅ Event delegation for dynamically added rows
            $('#MemTable').on('change', '.category-select', function() {
                let $row = $(this).closest('tr');
                let categoryId = $(this).val();
                let $subcategorySelect = $row.find('.subcategory-select');

                $.ajax({
                    type: "GET",
                    url: "/get-equipments-by-subcategory",
                    data: {
                        categoryId
                    },
                    dataType: "json",
                    success: function(response) {
                        $subcategorySelect.empty().append(
                            '<option value="">Select One</option>');
                        $.each(response, function(key, value) {
                            $subcategorySelect.append(
                                `<option value="${key}">${value}</option>`);
                        });
                    }
                });
            });

            // ✅ Recalculate price when rate or quantity changes
            $('#MemTable').on('input', '.rate-input, .quantity-input', function() {
                let $row = $(this).closest('tr');
                let rate = parseFloat($row.find('.rate-input').val()) || 0;
                let quantity = parseFloat($row.find('.quantity-input').val()) || 0;
                $row.find('.price-input').val((rate * quantity).toFixed(2));
            });

            // ✅ Delete row
            $('#MemTable').on('click', '.btnDeleteMem', function() {
                $(this).closest('tr').remove();
            });

            // ✅ Helper function to find max row id
            function findTableMaxRowId(table_id) {
                let rows = $(table_id + " tr");
                return rows.length > 0 ? (rows.last().data("rowid") || 0) : 0;
            }
        });
    </script>
    {{-- <script>
        $('#requisitiondate').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            orientation: "bottom left"
        });

        function getFinancialYear() {
            const dateInput = document.getElementById('bdate').value; // "2025-09-14"
            if (!dateInput) return "";

            const date = new Date(dateInput);
            const month = date.getMonth() + 1; // JS months are 0-based
            const year = date.getFullYear();

            let startYear, endYear;
            if (month >= 7) {
                startYear = year;
                endYear = year + 1;
            } else {
                startYear = year - 1;
                endYear = year;
            }
            return `${startYear}-${endYear}`;
        }

        // Auto-update Financial Year when date changes
        document.getElementById('bdate').addEventListener('change', function() {
            const fy = getFinancialYear();
            document.getElementById('fy').value = fy; // ✅ set the FY field value
        });

        // Optional: set initial FY on page load if date is already filled
        window.addEventListener('DOMContentLoaded', function() {
            if (document.getElementById('bdate').value) {
                document.getElementById('fy').value = getFinancialYear();
            }
        });

        function getEquipmentbyCategory(rowId) {
            let categoryId = $('#categoryid').val();
            $.ajax({
                type: "GET",
                url: "/get-equipments-by-subcategory",
                data: {
                    categoryId
                },
                dataType: "json",
                success: function(response) {
                    $('#subcategoryid').empty().append('<option value="">Select One</option>');
                    $.each(response, function(key, value) {
                        $('#subcategoryid').append(`<option value="${key}">${value}</option>`);
                    });
                }
            });
        }

        let count_row = parseInt(findTableMaxRowId('#Metable'));
        const tableMem = $('#MemTable').children('tbody');
        $('#addRow').click(function() {
            count_row++;
            tableMem.append(`
            <tr data-rowid="${count_row}">
                <td>
                     <select class="form-control" id="categoryid" name="categoryid"
                         onchange="getEquipmentbyCategory()" required>
                        <option value="">Select One</option>
                         @foreach ($category as $item)
                        <option value="{{ $item->id }}">{{ $item->categoryname }}</option>
                        @endforeach
                     </select>
                </td>
                <td> 
                    <select class="form-control" id="subcategoryid" name="subcategoryid" required>
                     <option value="">Select One</option>
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control" name="techspecification[]" placeholder="Enter techspecification" required>
                </td>
                <td><input type="number" class="form-control rate-input" name="rate[]" value="1" min="0" required></td>
                <td><input type="number" class="form-control quantity-input" name="quantity[]" value="1" min="0" required></td>
                <td><input type="number" class="form-control price-input" name="price[]" value="1" readonly></td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btnDeleteMem"><i class="fa fa-times"></i></button>
                </td>
            </tr>
        `);

            let $newRow = tableMem.find(`tr[data-rowid="${count_row}"]`);

            $newRow.find('.rate-input, .quantity-input').on('input', function() {
                let rate = parseFloat($newRow.find('.rate-input').val()) || 0;
                let quantity = parseFloat($newRow.find('.quantity-input').val()) || 0;
                let price = rate * quantity;
                $newRow.find('.price-input').val(price.toFixed(2));
            });

            $newRow.find('.rate-input').trigger('input');
        });

        $("#MemTable").on('click', '.btnDeleteMem', function() {
            $(this).closest('tr').remove();
        });

        function findTableMaxRowId(table_id) {
            let rows = $(table_id + " tr");
            if (rows.length > 0) {
                return rows.last().data("rowid") || 0;
            }
            return 0;
        }
    </script> --}}
@endsection
