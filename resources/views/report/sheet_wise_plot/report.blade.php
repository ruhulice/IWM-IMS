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
                <a class="breadcrumb-item active" href="{{ url('/sheet-wise-plot') }}">Sheet Wise Plot</a>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->
    <!-- Page Content -->
    <div class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="block-content">
                    <div class="row modify_section">
                        <div class="col-md-12">
                            <div class="row" style="margin-top: 20px;">
                                {{-- <div class="col-sm-1">&nbsp;&nbsp;</div> --}}
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label class="control-label">বিভাগ:</label>
                                        <select class="form-control" id="Div" name="Div">
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
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label class="control-label">সিট নং:</label>
                                        <select class="form-control" id="Sheet" name="Sheet">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2" align="right">
                                    <div class="form-group">
                                        <label class="control-label">&nbsp;&nbsp;&nbsp;</label>
                                        <button type="button" class="btn btn-info" onclick="getSheetWisePlotData()" style="width:100%">View</button>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div> 



            <div class="col-md-12">
                <div class="block-content">
                    <div class="row modify_section">
                        <div class="col-md-12">
                            <div class="row" style="margin-top: 20px;">

                                <div class="col-md-12" id="sheet_pie"></div>

                            </div>
                        </div>
                    </div>
                </div> 
            </div> 

            <div class="col-md-4"> <br />
                <button onclick="window.print();" class="btn btn-primary">Print</button>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection

@section('js_after')
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        function getSheetWisePlotData(){
            var mauza = $('#Mouza').val();
            var mauza_code = $('#Mouza option:selected').attr('m_code');
            var sheet = $('#Sheet').val();
            console.log(sheet);
            if(mauza != undefined && mauza != ''){
            $.ajax({
                    type: 'POST',
                    url: 'GetSheetWisePlotSummary',
                    data: {
                        mauzaVal: mauza,
                        mauza_tab: mauza_code.toLowerCase(),
                        sheetVal: sheet,
                        "_token": $('#token').val()
                    },
                    success: function (data) {
                        console.log(data);
                        var totalPlots = 0;
                        var totalArea = 0;

                        data.summary.forEach(element => {
                            totalArea+=parseFloat(element.area_decimal);
                            totalPlots+=element.total_plots;
                        });

                        $majorclassData = [];
                        $subclassData = [];

                        // data.major_class.forEach(item =>{
                        //     $majorclassData.push({'name':item.major_class,'y': parseFloat(item.percentage)});
                        // });

                        // data.sub_class.forEach(item =>{
                        //     $subclassData.push({'name':item.sub_class,'y': parseFloat(item.percentage)});
                        // });

                        var html='<div class="col-md-12" style="padding-right:0px;"><h5 style="margin-bottom:10px;color:#ff9900;">মৌজার তথ্যঃ '+$mouzaName+ ' (সিট নং: ' + sheet + ')' + '</h5>';
                        html +='<table class="table table-bordered table-stripped"><tbody>';
                        html +='<tr><td>বিভাগের নাম</td><td>'+$divName+'</td></tr>';
                        html +='<tr><td>জেলার নাম</td><td>'+$distName+'</td></tr>';
                        html +='<tr><td>থানা/উপজেলার নাম</td><td>'+$upzName+'</td></tr>';
                        html +='<tr><td>মৌজার নাম</td><td>'+$mouzaName+'</td></tr>';
                        html +='<tr><td>মোট দাগ সংখ্যা</td><td><span class="btn btn-rounded btn-alt-danger" style="line-height: 5px;"> '+totalPlots.toString().getDigitBanglaFromEnglish()+'</span></td></tr>';
                        html += '</tbody></table></div>';

                        var majorClass = '<span style="padding:3px;"><b>ভূমি শ্রেণী অনুসারে তথ্য</b></span>';
                        majorClass +='<table class="table table-bordered table-stripped"><tbody>';
                        majorClass +='<tr><td>ভূমি শ্রেণী</td><td class="text-right">দাগ সংখ্যা</td><td class="text-right">শতকরা(%)</td></tr>';

                        data.major_class.forEach(item =>{
                            //majorClass +=  item.major_class + ', ' + item.plots + ', ' + item.percentage + '<br />';
                            majorClass +='<tr><td>'+item.major_class+'</td><td class="text-right">' + item.plots + '</td><td class="text-right">' + item.percentage + '</td></tr>';
                        });
                        majorClass += '</tbody></table></div>';

                        var subClass = '<span style="padding:3px;"><b>উপশ্রেণী অনুসারে তথ্য</b> </span>';
                        subClass +='<table class="table table-bordered table-stripped"><tbody>';
                        subClass +='<tr><td>ভূমি শ্রেণী</td><td>উপশ্রেণী</td><td class="text-right">দাগ সংখ্যা</td><td class="text-right">শতকরা(%)</td></tr>';
                        data.sub_class.forEach(item =>{
                            subClass +='<tr><td>'+item.major_class+'</td><td>'+item.sub_class+'</td><td class="text-right">' + item.plots + '</td><td class="text-right">' + item.percentage + '</td></tr>';
                        });
                        subClass += '</tbody></table></div>';

                        html += '<div class="col-md-6" style="float:left;"><div id="container1" style="border: 1px solid #ddd;">'+majorClass+'</div></div>';
                        html += '<div class="col-md-6" style="float:left; padding-right:0px;"><div id="container2" style="border: 1px solid #ddd;">'+subClass+'</div></div>';
                        $('#sheet_pie').html(html);
                    }
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please select a sheet first!',
                })
            }
        }

        $(document).ready(function(){
            pupulateCascadedropdowns();
        });
    </script>
@endsection
