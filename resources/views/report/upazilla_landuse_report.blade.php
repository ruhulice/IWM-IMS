@extends('layouts.backend-master')

@section('title', 'Report')
@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

    @endsection
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
            vertical-align: middle !important;
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
        .landuse-prc{
            font-size: 12px;
            font-family: sans-serif;
            color: #00bcd4;
        }
        .landuse{
            font-size: 14px;
            font-weight: 600;
        }
        .block{
            margin-bottom: 10px !important;
        }
        .chart_div{
            min-height: 400px;
        }
    </style>
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center" >
            <nav class="breadcrumb bg-body-light mb-0">
                <a class="breadcrumb-item" href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
                <a class="breadcrumb-item" href="{{ url('/report/upazilla-landuse') }}">Upazilla wise Landuse</a>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->

    <!-- Page Content -->
    <div class="content" style="padding: 5px !important;">

        <div class="row">
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
            <div class="col-sm-2 text-right">
                <div class="form-group">
                    <label class="control-label">&nbsp;&nbsp;&nbsp;</label>
                    <button type="button" class="btn btn-info" id="apply_filter" style="width:100%">Apply Filter</button>
                </div>
            </div>
            
        </div>

    
        <div class="block" style="padding: 0px; margin-bottom:0px;">
            <div class="block-content block-content-full">
                <div class="block-content" style="overflow-y: auto">
                    <h5 class="text-center">Upazilla wise Landuse</h3>
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="datatable"> 
                        <thead>
                            <tr>
                                <th class="text-left" >বিভাগ</th>
                                <th class="text-left" >জেলা</th>
                                <th class="text-left" >থানা</th>
                                <th class="text-left" >থানা কোড</th>
                                <th class="text-left" >ভূমি প্রকার</th>
                                <th class="text-right" >জমির পরিমান (হেক্টর)</th>
                                <th class="text-right" >জমির পরিমান (শতকরা %)</th>

                            </tr>
                        </thead>

                        
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- END Page Content -->
@endsection


@section('js_after')

    <!-- Page JS Plugins -->
    <!-- <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script> -->
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script> -->
    
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>


    <script src="{{ asset('assets/js/main.js') }}"></script>


    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
 -->

        <script>
            $(document).ready(function(){
                pupulateCascadedropdowns();

                var loadDataList = function (areaCode){
                    $("#datatable").dataTable().fnDestroy();
                    $('#datatable').DataTable({
                        pageLength: 10,
                        lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ], 
                        dom: 'Blfrtip',
                        buttons: [
                            'copyHtml5',
                            'excelHtml5',
                            'print'
                        ],

                        ajax: {
                            "url": "/report/upazilla-landuse/json/" + areaCode,
                            "type": "GET",
                            "dataSrc": "",
                        },
                        columns: [
                            { data: "m_div_bn" },
                            { data: "m_dist_bn" },
                            { data: "m_thana_bn" },
                            { data: "thana_code" },
                            { data: "majclass_b" },
                            { data: "hactor", className: "text-right" },
                            { data: "prc", className: "text-right" }
                            
                        ]

                    });
                };

                $("#apply_filter").on('click', function (evt) {
                    var div = $('#Div').val();
                    var dist = $('#Dist').val();
                    var upz = $('#Upz').val();
                    if(upz != undefined && upz != ''){
                        loadDataList(upz); // apply filter with upz code
                    }else if(dist != undefined && dist != '')
                    {
                        loadDataList(dist); // apply filter with dist code
                    }else if(div != undefined && div != '')
                    {
                        loadDataList(div); // apply filter with div code
                    }

                });

                loadDataList(0); // initially 0 for loading all data




            });
        </script>
@endsection
