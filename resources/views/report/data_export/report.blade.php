@extends('layouts.backend-master')
@section('title', 'Dashboard')
@section('css_before')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link href="{{ asset('assets/exportData/css/buttons.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<style>
    .starisk{
        color:#e60a0a;
    }
</style>

    <!-- Start Breadcrumb -->
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center" >
            <nav class="breadcrumb bg-body-light mb-0">
                <a class="breadcrumb-item" href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
                <span class="breadcrumb-item">Reporting</span>
                <a class="breadcrumb-item active" href="{{ url('/data-export') }}">Data Export Tool</a>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->
    <!-- Page Content -->
    <div class="content">
   
    <div class="block">
    <div class="content" style="padding: 5px !important;">
        <div class="col-md-12 js-appear-enabled animated fadeIn" data-toggle="appear">
            <div class="col-md-12">
                <div class="Container">
                    <br>
                    <div class="row">
                        {{-- <div class="col-sm-1">&nbsp;&nbsp;</div> --}}
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label">বিভাগ: <span class="starisk">*</span></label>
                                <select class="form-control" id="Div" name="">
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label">জেলা: <span class="starisk">*</span></label>
                                <select class="form-control" id="Dist" name="Dist">
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label">থানা/উপজেলা: <span class="starisk">*</span></label>
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
                                <label class="control-label">ফাইল টাইপ: <span class="starisk">*</span></label>
                                <select class="form-control" id="download" name="download">
                                    <option value="shp">Shape File</option>
                                    <option value="xlsx">Excel</option>
                                    <option value="csv">CSV</option>
                                    <option value="kml">KML</option>
                                    <option value="geojson">Geo Json</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2" align="right">
                            <div class="form-group">
                                <label class="control-label">&nbsp;&nbsp;&nbsp;</label>
                                {{-- {!! Form::open(['route' => 'GetExportData', 'id'=>'dataInput']) !!} --}}
                                {!! Form::open(['route' => 'DownloadData', 'id'=>'dataInput']) !!}
                                    <button type="button" class="btn btn-success" onclick="export_to_excel()">Export Data</button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">&nbsp;&nbsp;&nbsp;</div>
        </div>
</div>
</div>


        {{-- <div class="block" style="padding: 0px; margin-bottom:0px;">
            <div class="block-content block-content-full">
                <div class="block-content" style="overflow-y: auto" id="box_content">
                    <h5 class="text-center">Data Export Tool</h3>
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="data_table"> 
                        <thead>
                            <tr>
                                <th>div_code</th>
                                <th>dist_code</th>
                                <th>thana_code</th>
                                <th>m_code</th>
                                <th>m_div_en</th>
                                <th>m_div_bn</th>
                                <th>m_dist_en</th>
                                <th>m_dist_bn</th>
                                <th>m_thana_en</th>
                                <th>m_thana_bn</th>
                                <th>m_name_en</th>
                                <th>m_name_bn</th>
                                <th>jl_no_en</th>
                                <th>jl_no_bn</th>
                                <th>sht_no_en</th>
                                <th>sht_no_bn</th>
                                <th>l_code_en</th>
                                <th>l_code_bn</th>
                                <th>l_name_en</th>
                                <th>l_name_bn</th>
                                <th>plot_no_en</th>
                                <th>plot_no_bn</th>
                                <th>sv_type_en</th>
                                <th>sv_type_bn</th>
                                <th>scale_en</th>
                                <th>scale_bn</th>
                                <th>sv_year_en</th>
                                <th>sv_year_bn</th>
                                <th>rev_no_en</th>
                                <th>rev_no_bn</th>
                                <th>geocode_en</th>
                                <th>remarks</th>
                                <th>geom</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($result as $item)
                                <tr>
                                    <td scope="row">{{ $item->div_code }}</td>
                                    <td scope="row">{{ $item->dist_code }}</td>
                                    <td scope="row">{{ $item->thana_code }}</td>
                                    <td scope="row">{{ $item->m_code }}</td>
                                    <td scope="row">{{ $item->m_div_en }}</td>
                                    <td scope="row">{{ $item->m_div_bn }}</td>
                                    <td scope="row">{{ $item->m_dist_en }}</td>
                                    <td scope="row">{{ $item->m_dist_bn }}</td>
                                    <td scope="row">{{ $item->m_thana_en }}</td>
                                    <td scope="row">{{ $item->m_thana_bn }}</td>
                                    <td scope="row">{{ $item->m_name_en }}</td>
                                    <td scope="row">{{ $item->m_name_bn }}</td>
                                    <td scope="row">{{ $item->jl_no_en }}</td>
                                    <td scope="row">{{ $item->jl_no_bn }}</td>
                                    <td scope="row">{{ $item->sht_no_en }}</td>
                                    <td scope="row">{{ $item->sht_no_bn }}</td>
                                    <td scope="row">{{ $item->l_code_en }}</td>
                                    <td scope="row">{{ $item->l_code_bn }}</td>
                                    <td scope="row">{{ $item->l_name_en }}</td>
                                    <td scope="row">{{ $item->l_name_bn }}</td>
                                    <td scope="row">{{ $item->plot_no_en }}</td>
                                    <td scope="row">{{ $item->plot_no_bn }}</td>
                                    <td scope="row">{{ $item->sv_type_en }}</td>
                                    <td scope="row">{{ $item->sv_type_bn }}</td>
                                    <td scope="row">{{ $item->scale_en }}</td>
                                    <td scope="row">{{ $item->scale_bn }}</td>
                                    <td scope="row">{{ $item->sv_year_en }}</td>
                                    <td scope="row">{{ $item->sv_year_bn }}</td>
                                    <td scope="row">{{ $item->rev_no_en }}</td>
                                    <td scope="row">{{ $item->rev_no_bn }}</td>
                                    <td scope="row">{{ $item->geocode_en }}</td>
                                    <td scope="row">{{ $item->remarks }}</td>
                                    <td scope="row"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}

    </div>
    <!-- END Page Content -->
@endsection

@section('js_after')
    {{-- <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/exportData/js/dataTables.buttons.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/exportData/js/jszip.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/exportData/js/pdfmake.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/exportData/js/vfs_fonts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/exportData/js/buttons.html5.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/exportData/js/buttons.print.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $("#data_table").dataTable().fnDestroy();
            $('#data_table').DataTable({
                dom:'Blfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'print'
                ]
            });
        });
    </script> --}}
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        function export_to_excel() {

           
            var div_code      = $('#Div').val();
            var dist_code     = $('#Dist').val();
            var upz_code    = $('#Upz').val();
            var mauza_code  = $('#Mouza').val();
            var download  = $('#download').val();
            

            if(div_code==null || dist_code == null || upz_code == null){
                //Swal.fire('বিভাগ/জেলা/থানা নির্বাচন করুন!');
                Swal.fire({
                    icon: 'error',
                    title: 'দুঃখিত...',
                    text: 'বিভাগ, জেলা, উপজেলা নির্বাচন করুন!',
                });
                return ;
            }

            if(div_code){
                $('#dataInput').append('<input type="hidden" name="div_code" value="'+div_code+'">');
            }
            if(dist_code){
                $('#dataInput').append('<input type="hidden" name="dist_code" value="'+dist_code+'">');
            }
            if(upz_code){
                $('#dataInput').append('<input type="hidden" name="upz_code" value="'+upz_code+'">');
            }
            if(mauza_code){
                $('#dataInput').append('<input type="hidden" name="mauza_code" value="'+mauza_code+'">');
            }

            $('#dataInput').append('<input type="hidden" name="download" value="'+download+'">');

            $('#dataInput').trigger('submit');
        }

        $(document).ready(function(){
            pupulateCascadedropdowns();
        });
    </script>
@endsection
