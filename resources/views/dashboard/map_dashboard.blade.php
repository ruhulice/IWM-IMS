@extends('layouts.backend-master')

@section('title', 'Dashboard')

@section('content')
    <style>
        .block-content {
            transition: opacity 0.2s ease-out;
            margin: 0 auto;
            /* padding: 20px 20px 1px; */
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
        /* #legend-div {
            position: absolute;
            right: 13px;
            bottom: 65px;
            z-index: 10000;
            width: auto;
            height: auto;
            background-color: #ffffff38;
            cursor: move;
        } */
        #legend-div {
            position: absolute;
            right: 13px;
            bottom: 65px;
            z-index: 10000;
            width: auto;
            height: auto;
            /* background-color: #ffffff38; */
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
        /* .ol-popup {
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
        } */
        .ol-overlaycontainer{
            top:0px;
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
        .ol-control.ol-bookmark {
            top: 6.5em !important;
            left: 0.5em !important;
            background-color: rgb(255 255 255) !important;
        }

        .ol-saveas, .ol-savelegend{
            display: none !important
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 30px !important;
            text-align: left;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow, .select2-container .select2-selection--single {
            height: 30px !important;
        }

        #toolbar .select2-container {
            margin-right: 5px;
        }

        /* .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #aaa;
            border-radius: 2px;
        } */
    </style>
    <link rel="stylesheet" href="{{ asset('assets/css/analysis.css') }}">
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center" style="padding: 24px 5px 1px;">
        <nav class="breadcrumb bg-body-light mb-0" id="geoLocationBC">
            <span class="breadcrumb-item" style="width: 50%;">&nbsp;</span>
                {{-- <a class="breadcrumb-item" href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
                <span class="breadcrumb-item">DMMS</span>
                <a class="breadcrumb-item" href="{{ route('dashboard') }}">Dashboard</a> --}}
            
        </nav>
        <div id="toolbar">
            <select id="ddl-landuse" class="form-select form-select-sm" aria-label="Input group example" aria-describedby="btnGroupAddon" onchange="landuseSelectionChanged()" aria-label=".form-select-sm example" style="margin-right: 10px;">
                <option value="">সকল ভুমি ব্যাবহার</option>
                @foreach ($landuses as $item)
                <option value="{{$item->maj_class_en}}">{{$item->maj_class_bn}}</option>
                @endforeach
            </select>
            {{-- <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text" style="line-height: 16px; border-color:#97a5ba;background-color:#fff" id="btnGroupAddon">@</div>
                </div>
                <select id="ddl-landuse" class="form-select form-select-sm" aria-label="Input group example" aria-describedby="btnGroupAddon" onchange="landuseSelectionChanged()" aria-label=".form-select-sm example" style="margin-right: 10px;">
                    <option value="">সকল ভুমি ব্যাবহার</option>
                    @foreach ($landuses as $item)
                    <option value="{{$item->maj_class_en}}">{{$item->maj_class_bn}}</option>
                    @endforeach
                </select>
            </div> --}}
            {{-- <div class="ol-select-rectangle ol-unselectable ol-control"><button title="Select by Rectangle"></button></div>
            <div class="ol-select-polygon ol-unselectable ol-control"><button title="Select by Polygon">P</button></div>
            <div class="ol-select-polygon ol-unselectable ol-control"><button title="Select by Polygon">P</button></div>
            <div class="ol-select-polygon ol-unselectable ol-control"><button title="Select by Polygon">P</button></div>
            <div class="ol-select-polygon ol-unselectable ol-control"><button title="Select by Polygon">P</button></div>
            <div class="ol-select-polygon ol-unselectable ol-control"><button title="Select by Polygon">P</button></div>
            <div class="ol-select-polygon ol-unselectable ol-control"><button title="Select by Polygon">P</button></div>
            <div class="ol-select-polygon ol-unselectable ol-control"><button title="Select by Polygon">P</button></div>
            <div class="ol-select-polygon ol-unselectable ol-control"><button title="Select by Polygon">P</button></div> --}}
            {{-- <div class="ol-print ol-unselectable ol-control"><button title="Print Map"><i class="fa fa-print"></i></button></div> --}}
            {{-- <div class="ol-print ol-unselectable ol-control" style="pointer-events: auto;"><button type="button" title="Print"></button></div> --}}
        </div>
        </div>
    </div>
    <!-- END Breadcrumb -->

    <!-- Page Content -->
    <div class="content" style="padding: 5px !important;">
        <div id="map-print" class="block" style="padding: 0px; margin-bottom:0px;">
            {{-- <div id="printControl" class="col-md-4"">
                <select id="format">
                    <option value="a1">A1</option>
                    <option value="a2">A2</option>
                    <option value="a3">A3</option>
                    <option value="a4" selected>A4</option>
                  </select>
                  <select id="resolution">
                    <option value="72">72 dpi (fast)</option>
                    <option value="150">150 dpi</option>
                    <option value="200" selected>200 dpi</option>
                    <option value="300">300 dpi</option>
                  </select>
                  <button id="btnDownalod" class="btn btn-primary">Download</button>
                  <button id="btnClose" class="btn btn-info">Close</button>
            </div> --}}
            <div id="map" class="map-div block-content">
                {{-- <div id="legend-div">
                    <span style="">Legend</span>
                    <img id="legend"/>                    
                </div> --}}

            </div>
            <div id="popup" class="ol-popup">
                <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                <div id="popup-content"></div>
            </div>
        </div>
       
        {{-- <div class="map-div">
            <div id="map" class="map"></div>

            <div id="popup" class="ol-popup">
              <a href="#" id="popup-closer" class="ol-popup-closer"></a>
              <div id="popup-content"></div>
            </div>
          </div> --}}
    {{-- <div class="col-md-12 map-div">
        <div id="map" class="map"></div>
        <div id="popup" class="ol-popup">
            <a href="#" id="popup-closer" class="ol-popup-closer"></a>
            <div id="popup-content"></div>
          </div>
    </div> --}}
    </div>

    <!-- END Page Content -->
@endsection


@section('js_after')

    <script>
        $(function(){
            var adminArea =`<li class="open">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-cogs"></i><span class="sidebar-mini-hide">প্রশাসনিক এলাকা</span></a>
                        <ul class="div-content">
                            <li>
                                বিভাগ:
                                <select class="form-control" id="Div" name="">
                                </select>
                            </li>
                            <li>
                                জেলা:
                                <select class="form-control" id="Dist" name="Dist">
                                </select>
                            </li>
                            <li>
                                থানা/উপজেলা:
                                <select class="form-control" id="Upz" name="Upz">
                                </select>
                            </li>
                            <li>
                                মৌজা:
                                <select class="form-control" id="Mouza" name="Mouza">
                                </select>
                            </li>
                            <li>
                                <button type="button" class="btn btn-info" onclick="showMauzaSummary()" style="width:100%">মৌজার ভূমি ব্যবহারের সারাংশ</button>
                            </li>
                            <li>
                                সিট নং:
                                <select class="form-control" id="Sheet" name="Sheet">
                                </select>
                            </li>
                            <li>
                                প্লট:
                                <select class="form-control" id="Plot" name="Plot">
                                </select>
                            </li>
                        </ul>
                    </li>
                <hr/>`;

            $('#nav-bar-land li').first().prepend(adminArea);

        })
    </script>
{{--<script>
    $(function(){
        var adminArea =`<li class="open">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-cogs"></i><span class="sidebar-mini-hide">Administrative Area</span></a>
                    <ul class="div-content">
                        <li>
                            বিভাগ:
                            <select class="form-control" id="Div" name="">
                            </select>
                        </li>
                        <li>
                            জেলা:
                            <select class="form-control" id="Dist" name="Dist">
                            </select>
                        </li>
                        <li>
                            থানা/উপজেলা:
                            <select class="form-control" id="Upz" name="Upz">
                            </select>
                        </li>
                        <li>
                            ইউনিয়ন/ওয়ার্ড:
                            <select class="form-control" id="Uni" name="Uni">
                            </select>
                        </li>
                        <li>
                            মৌজা:
                            <select class="form-control" id="Mouza" name="Mouza">
                            </select>
                        </li>
                        <li>
                            <button type="button" class="btn btn-info" onclick="showMauzaSummary()" style="width:100%">View Mauza Summary</button>
                        </li>
                        --}}{{-- <li>
                            Sheet:
                            <select class="form-control" id="Sheet" name="Sheet">
                            </select>
                        </li> --}}{{--
                        <li>
                            প্লট:
                            <select class="form-control" id="Plot" name="Plot">
                            </select>
                        </li>
                    </ul>
                </li>
            <hr/>`;

            $('#nav-bar-land li').first().prepend(adminArea);

    })
</script>--}}
    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/chartjs/Chart.bundle.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/plugins/ckeditor/ckeeditor.js') }}"></script> --}}
    <!-- Page JS Code -->
    <script src="https://unpkg.com/dom-to-image-more@2.8.0/dist/dom-to-image-more.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/eligrey/FileSaver.js/aa9f4e0e/FileSaver.min.js"></script>


    <script src="{{ asset('assets/js/plugins/highchart/highcharts.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/highchart/exporting.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/highchart/export-data.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/highchart/accessibility.js') }}"></script>

    <script src="{{ asset('assets/js/pages/be_pages_dashboard.min.js') }}"></script>
    {{-- <script src='https://unpkg.com/@turf/turf@6/turf.min.js'></script> --}}
    <script src="{{ asset('assets/js/main.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script> --}}


    <script>
        $('.activationModeClick').on('click',function(){
            if($($('.activationModeClick')[0]).hasClass('shown')){
            //alert('hide');
            $('#legend').hide();
        }
        else{
            $('#legend').show();
        }
        });


        $(document).ready(function(){
            $('#toolbar').append( $('.ol-print'));
        });

        //$(document).ajaxStart($.blockUI({ message : '<div class="spinner-border text-danger"></div> <span style="font-size: 24px;margin-left: 5px;color: #dd4141;">Please wait...</span>'})).ajaxStop($.unblockUI);

        </script>
@endsection
