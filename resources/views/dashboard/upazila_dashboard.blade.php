@extends('layouts.backend-master')
@section('title', 'Dashboard')
@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slider.css') }}">
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
            #datatable_info, #datatable_length{
                width: 50%;
                float: left;
            }
            .page-item.active .page-link {
            z-index: 1;
            color: #fff;
            background-color: #3f9ce8;
            border-color: #3f9ce8;
        }

        .pagination > li > a, .pagination > li > span {
            margin-top: 5px;
            margin-bottom: 5px;
            -webkit-transition: all .3s;
            -moz-transition: all .3s;
            transition: all .3s;
        }
        .page-link {
            font-weight: 600;
        }
        .page-link {
            position: relative;
            display: block;
            padding: 0.57142857rem 0.71428571rem;
            margin-left: -1px;
            line-height: 1.2;
            color: #171717;
            background-color: #f0f2f5;
            border: 1px solid #f0f2f5;
        }
        .text-earth-light {
            color: #673ab7 !important;
        }
    </style>

    <div class="bg-body-light border-b">
        <div class="content py-5 text-center" >
        <nav class="breadcrumb bg-body-light mb-0" id="geoLocationBC">
                <a class="breadcrumb-item" href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
                <a class="breadcrumb-item" href="{{ url('/upazila-dashboard') }}">Upazila Dashboard</a>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->

    <!-- Page Content -->
    <div class="content" style="padding: 5px !important;">
        <div class="row js-appear-enabled animated fadeIn" data-toggle="appear">
            <div class="col-md-12">
                <div class="Container">
                    <h3 style="margin-bottom: 0px" class="Head">থানা/উপজেলা অনুসারে আপলোডেড মৌজা ও সিট সংখ্যাঃ<span class="Arrows"></span></h3>
                    <!-- Carousel Container -->
                    <div class="SlickCarousel">
                     
                      <!-- Item -->
                      <div class="ProductBlock">
                        <a class="block block-rounded block-bordered block-link-shadow" href="javascript:void(0)">
                            <div class="block-content block-content-full clearfix">
                                <div class="float-right mt-15 d-none d-sm-block">
                                    <i class="si fa-2x text-earth-light"></i>
                                </div>
                                <div class="font-size-h3 font-w600 text-earth"><span data-toggle="countTo" data-speed="1000" data-to="" class="js-count-to-enabled">মোট মৌজা</span></div>
                                <div class="font-size-sm font-w600 text-uppercase text-muted"><span class="count-osk">{{$counts[0]->mouza}}</span></div>
                            </div>
                        </a>
                      </div>                      
                      <!-- Item -->
                      <div class="ProductBlock">
                        <a class="block block-rounded block-bordered block-link-shadow" href="javascript:void(0)">
                            <div class="block-content block-content-full clearfix">
                                <div class="float-right mt-15 d-none d-sm-block">
                                    <i class="si fa-2x text-earth-light"></i>
                                </div>
                                <div class="font-size-h3 font-w600 text-earth"><span data-toggle="countTo" data-speed="1000" data-to="" class="js-count-to-enabled">মোট মৌজা সিট</span></div>
                                <div class="font-size-sm font-w600 text-uppercase text-muted"><span class="count-osk">{{$counts[0]->sheet}}</span></div>
                            </div>
                        </a>
                      </div>                      
                      @foreach ($upzWiseCounts as $item)
                      <div class="ProductBlock">
                        <a class="block block-rounded block-bordered block-link-shadow" href="javascript:void(0)">
                            <div class="block-content block-content-full clearfix">
                                <div class="float-right mt-15 d-none d-sm-block">
                                    <i class="si fa-2x text-earth-light" style="font-size: 1.5em;"><span style="font-size: 15px;">মৌজাঃ</span> {{$item->mouza}}</i>
                                </div>
                                <div class="font-size-h3 font-w600 text-earth">{{$item->m_thana_bn}}</div>
                                <div class="font-size-sm font-w600 text-uppercase text-muted"><span style="font-size: 15px;">সিটঃ {{$item->sheet}}</span> </div>
                            </div>
                        </a>
                      </div>
                      @endforeach
                       <!-- Item -->
                       <div class="ProductBlock">
                        <a class="block block-rounded block-bordered block-link-shadow" href="javascript:void(0)">
                            <div class="block-content block-content-full clearfix">
                                <div class="float-right mt-15 d-none d-sm-block">
                                    <i class="si fa-2x text-earth-light"></i>
                                </div>
                                <div class="font-size-h3 font-w600 text-earth"><span data-toggle="countTo" data-speed="1000" data-to="" class="js-count-to-enabled">মোট থানা/উপজেলা</span></div>
                                <div class="font-size-sm font-w600 text-uppercase text-muted"><span class="count-osk">{{$counts[0]->thana}}</span></div>
                            </div>
                        </a>
                      </div>                     
                      <!-- Item -->
                    </div>
                    <!-- Carousel Container -->
                  </div>
            </div>
            <!-- Row #4 -->
            <div class="col-md-8" style="padding-right: 0px">
                <div class="block">
                    <div class="block-content block-content-full" style="padding-bottom: 0px">
                        <div class=" text-center">
                            <div id="div_column" class="chart_div"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="block">
                    <div class="block-content block-content-full" style="padding-bottom: 0px">
                        <div class=" text-center">
                            <div id="major_class_pie" class="chart_div"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Row #4 -->
        </div>

        <div class="block" style="padding: 0px; margin-bottom:0px;">
            <div class="block-content block-content-full">
                <div class="block-content" style="overflow-y: auto">
                    <h5 class="text-center">প্রধান শ্রেণী অনুসারে জমি (হেক্টর) ও শতকরা পরিমাণঃ</h3>
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="datatable"> 
                        <thead>
                            <tr>
                                <th class="" style="">বিভাগ</th>
                                <th class="" style="">জেলা</th>
                                <th class="" style="">উপজেলা</th>
                                @foreach ($major_class as $item)
                                    <th class="text-center" style="min-width:120px;white-space: nowrap;">{{$item->majclass_b}}</th>
                                @endforeach                               
                            </tr>
                        </thead>
                        <tbody>
                            @php $j = 0 @endphp
                                @foreach ($thanas as $item)
                                <tr>
                                    <th class="" scope="row">{{$item->m_div_bn}}</th>
                                    <th class="" scope="row">{{$item->m_dist_bn}}</th>
                                    <th class="" scope="row">{{$item->m_thana_bn}}</th>
                                    @foreach ($major_class as $maj_class)
                                        <td class="text-center" style=""><span class="landuse">{{number_format($result[$j]->hactor, 2, '.', ',');}}</span> <span class="landuse-prc">({{$result[$j]->prc}}%)</span></td>
                                        @php $j++ @endphp
                                    @endforeach
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- END Page Content -->
@endsection

@section('js_after')
    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/plugins/datatables/dataTables.buttons.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons.colVis.min.js') }}"></script> --}}

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/chartjs/Chart.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/highchart/highcharts.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/highchart/exporting.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/highchart/export-data.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/highchart/accessibility.js') }}"></script>
    <script src="{{ asset('assets/js/slick.js') }}"></script>
    <script>
        $(document).ready(function(){
            $(".SlickCarousel").slick({
                    rtl:false, 
                    autoplay:false, 
                    autoplaySpeed:5000, //  Slide Delay
                    speed:800, // Transition Speed
                    slidesToShow:6, // Number Of Carousel
                    slidesToScroll:6, // Slide To Move 
                    appendArrows:$(".Container .Head .Arrows"), // Class For Arrows Buttons
                    prevArrow:'<span class="Slick-Prev"></span>',
                    nextArrow:'<span class="Slick-Next"></span>',
                    easing:"linear",
                    infinite: false,
                    responsive:[
                    {breakpoint:801,settings:{
                        slidesToShow:3,
                    }},
                    {breakpoint:641,settings:{
                        slidesToShow:3,
                    }},
                    {breakpoint:481,settings:{
                        slidesToShow:1,
                    }},
                    ],
                });

            $('#datatable').DataTable({
                buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
            });
            var data =  @json($major_class_data);
            var thanas = @json($thanas);
            var result = @json($result);
            $majorClass = [];
            $thana = [];
            // console.log(result);
            thanas = thanas.sort((a, b) => {
                if (a.m_thana_bn < b.m_thana_bn) {
                    return -1;
                }
            });
            // console.log(thanas);
            thanas.forEach(item =>{
                $thana.push(item.m_thana_bn);
            });
            // console.log('data',$thana);
            $majorclassData =[];
            $majorclassColumnChartData = [];

            result = result.sort((a, b) => {
                if (a.m_thana_bn < b.m_thana_bn) {
                    return -1;
                }
            });
            //console.log('data',data);
            data.forEach(item =>{
                $majorclassData.push({'name':item.major_class,'y': parseFloat(item.hactor) ,'hactor':item.hactor});
                //console.log('data',result);
                $data = [];
                var thanaDetails = result.filter(x=> x.maj_class === item.maj_class && x.majclass_b === item.major_class);
                // console.log('divDet',thanaDetails);
                $thana.forEach(thana => {
                    var item = thanaDetails.filter(x=>x.m_thana_bn == thana)[0];
                    // console.log(item);
                    $data.push(parseFloat(item.hactor));
                });
                // thanaDetails.forEach(item=>{
                //     $data.push({'thana':item.m_thana_bn,'hac':parseFloat(item.hactor)});
                // });                    
                $visible = false;
                if(item.maj_class.toLowerCase().includes('residential') || item.maj_class.toLowerCase().includes('bodies') || item.maj_class.toLowerCase().includes('agricultural')){
                    $visible = true;
                }
                
                // console.log($data);
                $majorclassColumnChartData.push({'name':item.major_class,'data':$data,visible: $visible});
                
            });
            //console.log('majclass',$majorclassColumnChartData);
            //console.log('thana',$thana);

            Highcharts.chart('major_class_pie', {
                colors: ["#7cb5ec", "#434348", "#90ed7d", "#f7a35c",'#2f7ed8', '#0d233a', '#8bbc21', '#910000', '#1aadce','#492970', '#f28f43', '#77a1e5', '#c42525', '#a6c96a','#4572A7', '#AA4643', '#89A54E', '#80699B', '#3D96AE','#DB843D', '#92A8CD', '#A47D7C', '#B5CA92'],
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'প্রধান শ্রেণী অনুসারে জমির পরিমাণঃ'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.hactor:.2f} ha, {point.percentage:.2f}%</b>'
                },
                accessibility: {
                    point: {
                    valueSuffix: 'ha'
                    }
                },
                plotOptions: {
                    pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.hactor:.1f} ha'
                    }
                    }
                },
                series: [{
                    name: '',
                    colorByPoint: true,
                    data: $majorclassData
                }]
            });

            Highcharts.chart('div_column', {
                colors: ["#7cb5ec", "#434348", "#90ed7d", "#f7a35c",'#2f7ed8', '#0d233a', '#8bbc21', '#910000', '#1aadce','#492970', '#f28f43', '#77a1e5', '#c42525', '#a6c96a','#4572A7', '#AA4643', '#89A54E', '#80699B', '#3D96AE','#DB843D', '#92A8CD', '#A47D7C', '#B5CA92'],
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'প্রধান শ্রেণী অনুসারে জমির পরিমাণঃ'
                },                    
                xAxis: {
                    categories: $thana,
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'জমির পরিমাণঃ (হেক্টর)'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.1f} ha</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: $majorclassColumnChartData
            });

        });

        // $(document).ready(function(){
        //     $('#data-table').DataTable();
        // });
    </script>
@endsection
