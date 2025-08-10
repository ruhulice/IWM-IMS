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
                <span class="breadcrumb-item active">Requisition Dashboard</span>
            </nav>
        </div>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="block modify_section">
                    <form action="{{ route('admin.requisitions.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="block-header block-header-default">
                            <h2 class="block-title">Requisition Create</h2>
                            <div class="block-options">
                                <a class="btn btn-danger" href="{{ route('admin.requisitions.index') }}">Back</a>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>

                        <div class="block-content">
                            <div class="row modify_section">
                                <div class="col-md-12">
                                    <div class="row">
                                        {{-- <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Requisition By <span
                                                        style="color: red">*</span></label>
                                                <select class="form-control selectpicker" data-live-search="true"
                                                    name="requisitionby" required>
                                                    <option value="">Select One</option>
                                                    @foreach ($users as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Division <span
                                                        style="color: red">*</span></label>
                                                <select class="form-control" id="divisionid" name="divisionid"
                                                    onchange="getDistrictListByDivCode()" required>
                                                    <option value="">Select One</option>
                                                    @foreach ($divisions as $item)
                                                        <option value="{{ $item->divid }}">{{ $item->divisionname }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Project <span
                                                        style="color: red">*</span></label>
                                                <select class="form-control" id="projectno" name="projectno" required>
                                                    <option value="">Select One</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Requisition Date <span
                                                        style="color: red">*</span></label>
                                                <input type="text" class="form-control" id="requisitiondate"
                                                    name="requisitiondate" value="{{ date('Y-m-d') }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Purpose of Requisition <span
                                                        style="color: red">*</span></label>
                                                <textarea class="form-control" id="reqpurpose" name="reqpurpose" rows="3" required>{{ old('reqpurpose') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Upload PDF</label>
                                                <input type="file" name="pdffile" id="pdffile"
                                                    class="form-control-file" accept="application/pdf">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row modify_section">
                                <div class="col-md-12 d-flex justify-content-between align-items-center">
                                    <h5>Equipments List</h5>
                                    <button id="addRow" type="button" class="btn btn-sm btn-success">Add New +</button>
                                </div>

                                <div class="col-md-12">
                                    <table id="MemTable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Category <span style="color: red">*</span></th>
                                                <th>Sub Category <span style="color: red">*</span></th>
                                                <th>Technical Specification <span style="color: red">*</span></th>
                                                <th>Rate(Approx.) <span style="color: red">*</span></th>
                                                <th>Quantity <span style="color: red">*</span></th>
                                                <th>Price (With VAT & IT) <span style="color: red">*</span></th>
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
        $('#requisitiondate').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            orientation: "bottom left"
        });

        function getDistrictListByDivCode() {
            let division_code = $('#divisionid').val();
            // console.log(division_code);
            $.ajax({
                type: "GET",
                url: "/bd-district-list",
                data: {
                    division_code
                },
                dataType: "json",
                success: function(response) {
                    $('#projectno').empty().append('<option value="">Select One</option>');
                    $.each(response, function(key, value) {
                        $('#projectno').append(`<option value="${value}">${value}-${key}</option>`);
                    });
                }
            });
        }

        function getEquipmentbyCategory(rowId) {
            let categoryId = $('#categoryid' + rowId).val();
            $.ajax({
                type: "GET",
                url: "/get-equipments-by-subcategory",
                data: {
                    categoryId
                },
                dataType: "json",
                success: function(response) {
                    $('#subcategoryid' + rowId).empty().append('<option value="">Select One</option>');
                    $.each(response, function(key, value) {
                        $('#subcategoryid' + rowId).append(`<option value="${key}">${value}</option>`);
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
                    <select class="form-control" id="categoryid${count_row}" name="categoryid[]" onchange="getEquipmentbyCategory(${count_row})" required>
                        <option value="">Select One</option>
                        @foreach ($category as $item)
                            <option value="{{ $item->id }}">{{ $item->categoryname }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select class="form-control" id="subcategoryid${count_row}" name="subcategoryid[]" required>
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
    </script>
@endsection
