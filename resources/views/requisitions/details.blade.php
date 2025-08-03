@extends('layouts.backend-master')
@section('title', 'SDEMS Equipment Transfer Details')
@section('content')
    <style>
        .vl {
        border-left: .5px solid black;
        height: 500px;
        }
    </style>
    <!-- Breadcrumb -->
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center">
            <nav class="breadcrumb bg-body-light mb-0">
                <a class="breadcrumb-item" href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
                <a class="breadcrumb-item" href="{{ route('admin.transfer.index') }}">Equipment Transfer</a>
                <span class="breadcrumb-item active">Details</span>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->
    <!-- Page Content -->
    <div class="content">
        <!-- Equipment Transfer -->
        <div class="row">
            <div class="col-md-12">
                <div class="block modify_section">
                    <div class="block-header block-header-default">
                        <h2 class="block-title">Equipment Transfer Details - {{ $result->eqpInfo->asset_name }}</h2>
                        <div class="block-options">
                            <a type="button" class="btn btn-danger" href="{{ route('admin.transfer.index') }}">Back</a>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row modify_section">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="font-weight-bold">From User <span style="color: #FF0000">*</span></label>
                                            <select class="form-control" id="sdfrom_user_id" disabled>
                                                <option value="">Select One</option>
                                                @foreach($users as $item)
                                                    <option value="{{ $item->id }}" {{ $result->from_user_id == $item->id ? 'selected' : '' }} >{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="font-weight-bold">To User <span style="color: #FF0000">*</span></label>
                                            <select class="form-control" id="sdto_user_id" disabled>
                                                <option value="">Select One</option>
                                                @foreach($users as $item)
                                                    <option value="{{ $item->id }}" {{ $result->to_user_id == $item->id ? 'selected' : '' }} >{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Transfer Date <i class="fa fa-calendar icon-calendar"></i> <span style="color: #FF0000">*</span></label>
                                            <input type="text" data-format="yyyy-mm-dd" class="form-control" id="sdftr" value="{{ $result->transfer_date }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Equipments <span style="color: #FF0000">*</span></label>
                                            <select class="form-control" id="sdequipment_id" disabled>
                                                <option value="">Select One</option>
                                                @foreach($equipments as $item)
                                                    <option value="{{ $item->id }}" {{ $result->equipment_id == $item->id ? 'selected' : '' }} >{{ $item->asset_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Quantity <span style="color: #FF0000">*</span></label>
                                            <input type="number" class="form-control" id="sdquantity" value="{{ $result->quantity }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Asset Condition <span style="color: #FF0000">*</span></label>
                                            <select class="form-control" id="sdcondition_id" disabled>
                                                <option value="">Select One</option>
                                                @foreach($conditions as $item)
                                                    <option value="{{ $item->id }}" {{ $result->condition_id == $item->id ? 'selected' : '' }} >{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Remarks <span style="color: #FF0000">*</span></label>
                                            <textarea class="form-control" id="sdremarks" disabled>{{ $result->remarks }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Division <span style="color: #FF0000">*</span></label>
                                            <select class="form-control" id="sddivision_code" disabled>
                                                <option value="">Select One</option>
                                                @foreach($divisions as $item)
                                                    <option value="{{ $item->code }}" {{ $result->division_code == $item->code ? 'selected' : '' }} >{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="font-weight-bold">District <span style="color: #FF0000">*</span></label>
                                            <select class="form-control" id="sddistrict_code" disabled>
                                                <option value="">Select One</option>
                                                @foreach($districts as $item)
                                                    <option value="{{ $item->code }}" {{ $result->district_code == $item->code ? 'selected' : '' }} >{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Upazila <span style="color: #FF0000">*</span></label>
                                            <select class="form-control" id="sdupazila_code" disabled>
                                                <option value="">Select One</option>
                                                @foreach($upazilas as $item)
                                                    <option value="{{ $item->code }}" {{ $result->upazila_code == $item->code ? 'selected' : '' }} >{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Equipment Transfer -->
    </div>
    <!-- END Page Content -->
@endsection
