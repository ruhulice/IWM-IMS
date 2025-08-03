@extends('layouts.backend-master')
@section('title', 'Dashboard')
@section('content')
    <style>
        .block-content {
            transition: opacity 0.2s ease-out;
            margin: 0 auto;
            width: 100%;
            overflow-x: visible;
            padding: 5px;
        }
        .custom-mouse-position{
            color: #fff !important;
            text-align: right;
            padding-right: 5px;
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif
        }
        #popup-content .table th, .table td {
            padding: 2px 5px;
            vertical-align: top;
            border-top: 1px solid #e4e7ed;
        }
        .nav-link{
            cursor: pointer !important;
        }
        .nav-tabs .nav-link.active{
            color: #ffffff !important;
            background-color: #016734;
            border-color: #016734;
        }
        #popup-content .table {
            font-size: 13px;
        }
        #legend-div {
            position: absolute;
            right: 13px;
            bottom: 65px;
            z-index: 10000;
            width: auto;
            height: auto;
            cursor: move;
            display: flex;
            flex-direction: column;
            background-color: white;
            color: #950909;
            font-weight: bold;
            text-align: left;
            padding-left: 5px;
        }
        #legend-div img{
            width: 220px !important;
        }
        #popup-content .table th, .table td {
            padding: 2px 5px;
            vertical-align: top;
            border-top: 1px solid #e4e7ed;
            font-size: 11px;
        }
        .ol-popup {
            position: absolute;
            background-color: white;
            box-shadow: 0 1px 4px rgb(0 0 0 / 20%);
            padding: 8px;
            border-radius: 8px;
            border: 1px solid #cccccc;
            bottom: 12px;
            left: -50px;
            min-width: 350px;
            height: 300px;
        }
        .ol-popup h5, .h5 {
            font-size: 1.185714286rem;
            TEXT-ALIGN: CENTER;
        }

        #PlotDetails {
            max-height: 500px !important;
            overflow-y: auto !important;
        }
        .ol-control.ol-legend {
            bottom: 0.5em;
            left: 0.5em;
            z-index: 1;
            max-height: 90%;
            max-width: 90%;
            overflow-x: hidden;
            overflow-y: auto;
            background-color: rgb(255,255,255) !important;
        }
        .breadcrumb-item {
            padding-left: 0.5rem;
            color: #2196f3 !important;
            font-weight: bold;
        }
        #popup-content .table th, .table td {
            font-size: 14px;
        }
    </style>
    <!-- Start Breadcrumb -->
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center" >
            <nav class="breadcrumb bg-body-light mb-0">
                <a class="breadcrumb-item" href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
                <span class="breadcrumb-item">Reporting</span>
                <a class="breadcrumb-item active" href="{{ url('/mauza-summary') }}">Mauza Summary</a>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->
    <!-- Page Content -->
    <div class="content" style="padding: 5px !important;">
        <div class="row js-appear-enabled animated fadeIn" data-toggle="appear">
            
            
            <div class="col-md-12">
                <div class="block-content">
                    <div class="row modify_section">
                        <div class="col-md-12">
                            <div class="row" style="margin-top: 20px;">

                        <div class="col-sm-1">&nbsp;&nbsp;</div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label">বিভাগ:</label>
                                <select class="form-control" id="Div" name="">
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label">জেলা:</label>
                                <select class="form-control" id="Dist" name="Dist">
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label">থানা/উপজেলা:</label>
                                <select class="form-control" id="Upz" name="Upz">
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label">মৌজা:</label>
                                <select class="form-control" id="Mouza" name="Mouza">
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2" align="right">
                            <div class="form-group">
                                <label class="control-label">&nbsp;&nbsp;&nbsp;</label>
                                <button type="button" class="btn btn-info" onclick="getMauzaSummary()" style="width:100%">View Mauza Summary</button>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div> 




            <div class="col-md-12">&nbsp;&nbsp;&nbsp;</div>
            <!-- Row #4 -->
            <br><br/>
            <div class="col-md-12" style="padding-right: 0px;">
                <div class="block" id="mauza_pie"></div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/chartjs/Chart.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/highchart/highcharts.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/highchart/exporting.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/highchart/export-data.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/highchart/accessibility.js') }}"></script>
    <script src="{{ asset('assets/js/pages/be_pages_dashboard.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        $(document).ready(function(){
            pupulateCascadedropdowns();
        });
    </script>
@endsection
