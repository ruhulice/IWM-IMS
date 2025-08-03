@extends('layouts.backend-master')

@section('title', 'Create Menu')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('assets/css/user_management.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.css') }}">
@endsection

<style>
    .feedback-field-title {
        font-size: 17px;
        padding-top: 2px;
    }
    .sms-config-contain .switch {
        position: relative !important;
        display: inline-block !important;
        width: 60px !important;
        height: 34px !important;
    }
    .sms-config-contain .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
    .sms-config-contain .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: red;
        -webkit-transition: .4s;
        transition: .4s;
    }
    .sms-config-contain .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }
    .sms-config-contain input:checked + .slider {
        background-color: seagreen;
    }
    .sms-config-contain input:focus + .slider {
        box-shadow: 0 0 1px seagreen;
    }
    .sms-config-contain input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }
    /* Rounded sliders */
    .sms-config-contain .slider.round {
        border-radius: 34px;
    }
    .sms-config-contain .slider.round:before {
        border-radius: 50%;
    }
</style>


@section('content')

    <!-- Breadcrumb -->
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center">
            <nav class="breadcrumb bg-body-light mb-0">
                <a class="breadcrumb-item" href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
                <span class="breadcrumb-item">SMS Configuration</span>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->

    <!-- Page Content -->
    <div class="content sms-config-contain">
        <!-- Menus Create -->
        <div class="row">
            <div class="col-md-12">
                <!-- Menus Create Labels -->
                <div class="block">
                    <form action="{{ route('admin.SmsConfiguration.store') }}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        <div class="block-header block-header-default">
                            <h3 class="block-title">SMS Configuration</h3>
                            {{--<div class="block-options">
                                <a type="button" class="btn btn-danger" href="{{ url('/dashboard') }}">Cancel</a>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>--}}
                        </div>
                        <div class="block-content">
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold feedback-field-title">Feedback SMS On/Off</label>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="switch">
                                            @if($last_sms_configs->feedback_sms == true)
                                                <input class="form-control" name="feedback_sms" type="checkbox" checked>
                                            @else
                                                <input class="form-control" name="feedback_sms" type="checkbox">
                                            @endif
                                            <span class="slider round"></span>
                                        </label>
                                        {{--<input type="text" class="form-control" id="name" name="name" required>--}}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="block-options text-right">
                                        <a type="button" class="btn btn-danger" href="{{ url('/dashboard') }}">Cancel</a>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <!-- END Menus Create Labels -->
            </div>
        </div>
        <!-- END Menus Create -->


        <div class="block block-rounded">
            <div class="block-content" id="box_content">

                <div class="text-center">
                    <h5>Change LOG (Last 5)</h5>
                </div>
                <!-- Menus Table -->
                <table id="feedback-table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">SMS Feedback On/Off</th>
                        <th class="text-center">Changed By</th>
                        <th class="text-center">Change Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sms_configs as $key=>$config)
                        <tr>
                            <td class="text-center">{{ $key+1 }}</td>
                            <td class="red text-center">
                                @if($config->feedback_sms == true)
                                    <span class="badge badge-success">ON</span>
                                @else
                                    <span class="badge badge-danger">OFF</span>
                                @endif
                            </td>
                            <td class="text-center">{{ $config->updatedBy->name }}</td>
                            <td class="text-center">
                                {{ $config->created_at }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    {{--<tfoot>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">SMS Feedback On/Off</th>
                            <th class="text-center">Changed By</th>
                            <th class="text-center">Change Time</th>
                        </tr>
                    </tfoot>--}}
                </table>
                <!-- END Menus Table -->
            </div>
            <br><br>
        </div>


    </div>
    <!-- END Page Content -->

@endsection

@section('js_after')
    <script src="{{ asset('assets/js/plugins/select2/js/select2.full.js') }}"></script>
    <script type="text/javascript">
        $('.select2').select2();
    </script>
@endsection
