@extends('layouts.backend-master')
@section('title', 'Document List')
@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link href="{{ asset('assets/exportData/css/buttons.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

<style>
.checkbox-menu li label {
    display: block;
    padding: 3px 10px;
    clear: both;
    font-weight: normal;
    line-height: 1.42857143;
    color: #333;
    white-space: nowrap;
    margin:0;
    transition: background-color .4s ease;
}
.checkbox-menu li input {
    margin: 0px 5px;
    top: 2px;
    position: relative;
}

.checkbox-menu li.active label {
    background-color: #cbcbff;
    font-weight:bold;
}

.checkbox-menu li label:hover,
.checkbox-menu li label:focus {
    background-color: #f5f5f5;
}

.checkbox-menu li.active label:hover,
.checkbox-menu li.active label:focus {
    background-color: #b8b8ff;
}
.buttons-page-length{
    height:34px;
}
.block-content p, .block-content .push, .block-content .block, .block-content .items-push > div {
    margin-bottom: 0px;
}
.no-caret  .dropdown-toggle::after{
    display: none;
}
.dt-button{
    background: #fff !important;
}
#resolte-contaniner{
    height: 650px !important;
    padding: 10px !important;
    padding-bottom: 15px !important;
}
#resolte-contaniner .wtHolder, .handsontable{
    width: 100% !important;
}
.scroll{
    overflow-y: scroll;
    padding: 10px;
    border:1px solid #dddddd;
    /* border-radius: 5px; */
    margin: 10px;
}
.border{
        padding: 10px;
    border:1px solid #dddddd;
    /* border-radius: 5px; */
    margin: 10px;
}
.modal-dialog {
    max-width: 1200px;
    margin: 1.75rem auto;
    top:90px !important;
}
.modal-dialog .block-content {
    transition: opacity 0.2s ease-out;
    margin: 0 auto;
    padding: 0px 0px 1px;
    width: 100%;
    overflow-x: visible;
}
.wbSheets_clas {
    position: relative;
    padding: 1em;
    border: 1px solid #ccc;
    border-radius: 0px !important;
}
.block-header {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    padding: 8px 10px;
    transition: opacity 0.2s ease-out;
}
input[type=search] { 	
    height: 34px;;
}
</style>

    <!-- Breadcrumb -->
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center">
            <nav class="breadcrumb bg-body-light mb-0">
                <a class="breadcrumb-item" href="{{ url('/home') }}"><i class="fa fa-home"></i> Home</a>
                <span class="breadcrumb-item">DMMMS</span>
                <span class="breadcrumb-item active">Document List </span>
            </nav>
        </div>
    </div>

        @if ($message = Session::get('message'))
            @if(Session::get('alert-type')=='error')
                <!-- <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                </div> -->
                <script>
                        toastr.error({!!$message!!});
                </script>
            
            @else
            <!-- <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                </div> -->
                <script>
                        toastr.success("'{!!$message!!});
                </script>
            @endif
        @endif

    <!-- @if ($message = Session::get('message'))
                @if(Session::get('alert-type')=='error')
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                    </div>
                
                @else
                <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                    </div>
                @endif
            
            @endif -->
    <!-- END Breadcrumb -->
    <!-- Page Content -->
    <div class="content">
    
        <div class="content-heading" style="display: none">
            <a href="{{ route('documents.create') }}">
                <button type="button" class="btn btn-info float-right">
                    <i class="fa fa-plus"></i> | Add New
                </button>
            </a>
            &nbsp;&nbsp;
            Document List ({{ count($results) }})
        </div>
        <!-- Project List -->
        <div class="block block-rounded">
            <div class="block-content" id="box_content">
                <!-- Project List Table -->
                <table class="table table-bordered table-striped table-hover js-dataTable-full" id="pro_table" style="width:100%">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Title</th>
                            <th>Description</th>                           
                            <th>Type</th>                           
                            <th>Ref #</th>                           
                            <th>Client</th>                           
                            <th>Date</th>                           
                            <th>Subject</th>                           
                            <th>From</th>                           
                            <th>To</th>
                            <th>Remarks</th>                           
                            <th style="text-align:center">Actions</th>                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($results as $key=>$item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    <a class="font-w600" href="{{ route('documents.edit',$item->id) }}">{{ $item->title }}</a>
                                </td>
                                <td>{!! $item->description !!}</td>                                                               
                                <td>{{ $item->docTypeName->name }}</td>                                
                                <td>{{ $item->ref_no }}</td>                                
                                <td>{{ $item->client }}</td>                                
                                <td>{{ Carbon\Carbon::parse($item->date)->format('d-M-Y')}}</td>                                
                                <td>{{ $item->subject }}</td>                                
                                <td>{{ $item->from }}</td>                                
                                <td>{{ $item->to_whome }}</td>
                                <td>{{ $item->remarks }}</td>                         
                                <td style="text-align:center">
                                    <div class="btn-group no-caret" role="group" aria-label="Basic example">
                                        @if(count($item->documentfile) > 1)
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-primary dropdown-toggle" id="btnGroupView{{$key+1}}" title="view" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupView{{$key+1}}" style="">
                                                    @foreach ($item->documentfile as $file)
                                                    <a class="dropdown-item" onclick="viewFile('{!! $file->doc_link !!}','{!! $file->file_name!!}')" style="cursor: pointer;" >
                                                        {{$file->file_name}}
                                                    </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @else
                                            @foreach ($item->documentfile as $file)
                                                <a class="btn btn-primary" title="view" onclick="viewFile('{!! $file->doc_link !!}','{!! $file->file_name!!}')" style="cursor: pointer; color:#fff" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            @endforeach
                                        @endif
                                        @if(count($item->documentfile) > 1)
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-info dropdown-toggle" id="btnGroupDown{{$key+1}}" title="download" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-download" aria-hidden="true"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDown{{$key+1}}" style="">
                                                    @foreach ($item->documentfile as $file)
                                                    <a class="dropdown-item" href="{{$file->doc_link}}">
                                                        {{$file->file_name}}
                                                    </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @else
                                            @foreach ($item->documentfile as $file)
                                                <a class="btn btn-info" href="{{ $file->doc_link }}" title="download" target="_blank" title="View"><i class="fa fa-download" aria-hidden="true"></i></a>
                                            @endforeach
                                        
                                        @endif
                                        <a href="{{ route('documents.edit',$item->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i> </a>
                                        <form id="delete-form-{{$item->id}}" action="{{route('documents.destroy', $item->id)}}" method="post">
                                            @csrf @method('DELETE')
                                        </form>
                                        <a style='color:#fff; cursor:pointer;' onclick="confirmDelete({{$item->id}})" class="btn btn-danger" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i> </a>
                                    </div>
                                </td>                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- END Project List Table -->
            </div>
            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal-fadein" aria-hidden="true">
                <div class="modal-dialog" role="document" style="top:22%">
                    <div class="modal-content">
                        <div class="block block-rounded shadow-none mb-0">
                            <div class="block-header block-header-default">
                                <h3 class="block-title" id="modalTitle">Add a new document type:</h3>
                                <div class="block-options">
                                <button type="button" class="btn-block-option" onClick="CloseModal()" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-times"></i>
                                </button>
                                </div>
                            </div>
                            <div class="block-content fs-sm">
                                <div id="resolte-contaniner"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Project List -->
    </div>
    <!-- END Page Content -->

@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-ui/jquery-ui.js') }}"></script>

    <script src="{{ asset('assets/exportData/js/dataTables.buttons.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/exportData/js/jszip.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/exportData/js/pdfmake.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/exportData/js/vfs_fonts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/exportData/js/buttons.html5.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/exportData/js/buttons.print.min.js') }}" type="text/javascript"></script>

    <!--PDF--> 
    <link rel="stylesheet" href="{{ asset('assets/viewer/pdf/pdf.viewer.css') }}"> 
    <script src="{{ asset('assets/viewer/pdf/pdf.js') }}"></script> 
    <!--Docs-->
    <script src="{{ asset('assets/viewer/docx/jszip-utils.js') }}"></script>
    <script src="{{ asset('assets/viewer/docx/mammoth.browser.min.js') }}"></script>
    <!--PPTX-->
    <link rel="stylesheet" href="{{ asset('assets/viewer/PPTXjs/css/pptxjs.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/viewer/PPTXjs/css/nv.d3.min.css') }}">
    <!-- optional if you want to use revealjs (v1.11.0) -->
    <link rel="stylesheet" href="{{('assets/viewer/revealjs/reveal.css') }}">
    <link rel="text/javascript" href="{{('assets/viewer/revealjs/reveal.js') }}">
    <script type="text/javascript" src="{{ asset('assets/viewer/PPTXjs/js/filereader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/viewer/PPTXjs/js/d3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/viewer/PPTXjs/js/nv.d3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/viewer/PPTXjs/js/pptxjs.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/viewer/PPTXjs/js/divs2slides.js') }}"></script>

    <!--All Spreadsheet -->
    <link rel="stylesheet" href="{{ asset('assets/viewer/SheetJS/handsontable.full.min.css') }}">
    <script type="text/javascript" src="{{ asset('assets/viewer/SheetJS/handsontable.full.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/viewer/SheetJS/xlsx.full.min.js') }}"></script>
    <!--Image viewer--> 
    <link rel="stylesheet" href="{{ asset('assets/viewer/verySimpleImageViewer/css/jquery.verySimpleImageViewer.css') }}">
    <script type="text/javascript" src="{{ asset('assets/viewer/verySimpleImageViewer/js/jquery.verySimpleImageViewer.js') }}"></script>
    <!--officeToHtml-->
    <script src="{{ asset('assets/viewer/officeToHtml/officeToHtml.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/viewer/officeToHtml/officeToHtml.css') }}">

    <script>
        // $(function() {
        //     $('#pro_table').DataTable();
        // });
        var table;

        $pdfSetting =  {
            //setLang: "he",
            thumbnailViewBtn: true,
            searchBtn: true,
            nextPreviousBtn: true,
            pageNumberTxt: true,
            totalPagesLabel: true,
            zoomBtns: true,
            scaleSelector: true,
            presantationModeBtn: true,
            openFileBtn: false,
            printBtn: true,
            downloadBtn: true,
            bookmarkBtn: true,
            secondaryToolbarBtn: true,
            firstPageBtn: true,
            lastPageBtn: true,
            pageRotateCwBtn: true,
            pageRotateCcwBtn: true,
            cursorSelectTextToolbarBtn: true,
            cursorHandToolbarBtn: true
        };
        $docxSetting= {
            styleMap : null,
            includeEmbeddedStyleMap: true,
            includeDefaultStyleMap: true,
            convertImage: null,
            ignoreEmptyParagraphs: false,
            idPrefix: "",
            isRtl : "auto" 
        };
        $pptxSetting= {
            slidesScale: "50%", //Change Slides scale by percent
            slideMode: true, /** true,false*/
            slideType: "divs2slidesjs", /*'divs2slidesjs' (default) , 'revealjs'(https://revealjs.com) */
            revealjsPath: "", /*path to js file of revealjs. default:  './revealjs/reveal.js'*/
            keyBoardShortCut: true,  /** true,false ,condition: slideMode: true*/
            mediaProcess: true, /** true,false: if true then process video and audio files */
            jsZipV2: false,
            slideModeConfig: {
                first: 1,
                nav: true, /** true,false : show or not nav buttons*/
                navTxtColor: "black", /** color */
                keyBoardShortCut: false, /** true,false ,condition: */
                showSlideNum: true, /** true,false */
                showTotalSlideNum: true, /** true,false */
                autoSlide:1, /** false or seconds , F8 to active ,keyBoardShortCut: true */
                randomAutoSlide: false, /** true,false ,autoSlide:true */ 
                loop: true,  /** true,false */
                background: false, /** false or color*/
                transition: "default", /** transition type: "slid","fade","default","random" , to show transition efects :transitionTime > 0.5 */
                transitionTime: 1 /** transition time between slides in seconds */               
            },
            revealjsConfig: {} /*revealjs options. see https://revealjs.com */
        };
        $sheetSetting= {
            jqueryui : false,
            activeHeaderClassName: "",
            allowEmpty: true,
            autoColumnSize: true,
            autoRowSize: false,
            columns: false,
            columnSorting: true,
            contextMenu: false,
            copyable: true,
            customBorders: false,
            fixedColumnsLeft: 0,
            fixedRowsTop: 0,
            language:'en-US',
            search: false,
            selectionMode: 'single',
            sortIndicator: false,
            readOnly: false,
            startRows: 1,
            startCols: 1,
            rowHeaders: true,
            colHeaders: true,
            width: false,
            height:false
        };
        $imageSetting= {
            frame: ['100%', '100%',false],
            maxZoom: '900%',
            zoomFactor: '10%',
            mouse: true,
            keyboard: true,
            toolbar: true,
            rotateToolbar: false
        };

        function CloseModal(){
            $('#modal').modal('hide');
        }

        $(document).ready(function() {
            table = $('#pro_table').DataTable( {
                dom: 'Bfrtip',
                lengthMenu: [
                    [ 10, 25, 50, -1 ],
                    [ '10', '25', '50', 'Show All' ]
                ],
                buttons: [
                    // { extend: 'copy', text: '<i class="fas fa-file-copy fa-1x"> Copy</i>'},
                    // { extend: 'csv', text: '<i class="fas fa-file-csv fa-1x"> CSV</i>'},
                    { extend: 'excel', text: '<i class="fas fa-file-excel" aria-hidden="true"> EXCEL</i>' },
                    { extend: 'pdf', text: '<i class="fas fa-file-pdf fa-1x" aria-hidden="true"> PDF</i>' },
                    'pageLength'
                ]
            });

            $(`<div class="dropdown" style="float:right">
                <button class="dt-button dropdown-toggle" type="button" 
                        id="dropdownMenu1" data-toggle="dropdown" 
                        aria-haspopup="true" aria-expanded="true">
                    Show/hide column
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu checkbox-menu allow-focus" aria-labelledby="dropdownMenu1">
                    <li >
                    <label>
                        <input type="checkbox" name="columns" value="0" checked="true" onChange="showHideColumn()"> SL
                    </label>
                    </li>                    
                    <li >
                    <label>
                        <input type="checkbox" name="columns" value="1" checked="true" onChange="showHideColumn()"> Title
                    </label>
                    </li>                    
                    <li >
                    <label>
                        <input type="checkbox" name="columns" value="2" onChange="showHideColumn()"> Description
                    </label>
                    </li>
                    <li >
                    <label>
                        <input type="checkbox" name="columns" value="3" checked="true" onChange="showHideColumn()"> Type
                    </label>
                    </li>
                    <li >
                    <label>
                        <input type="checkbox" name="columns" value="4" checked="true" onChange="showHideColumn()"> Ref #
                    </label>
                    </li>
                    <li >
                    <label>
                        <input type="checkbox" name="columns" value="5" checked="true" onChange="showHideColumn()"> Client
                    </label>
                    </li>                    
                    <li >
                    <label>
                        <input type="checkbox" name="columns" value="6" checked="true" onChange="showHideColumn()"> Date
                    </label>
                    </li>
                    <li >
                    <label>
                        <input type="checkbox" name="columns" value="7" checked="true" onChange="showHideColumn()"> Subject
                    </label>
                    </li>
                    <li >
                    <label>
                        <input type="checkbox" name="columns" value="8" checked="true" onChange="showHideColumn()"> From
                    </label>
                    </li>
                    <li >
                    <label>
                        <input type="checkbox" name="columns" value="9" checked="true" onChange="showHideColumn()"> To
                    </label>
                    </li>
                    <li >
                    <label>
                        <input type="checkbox" name="columns" value="10" checked="true" onChange="showHideColumn()"> Remarks
                    </label>
                    </li>
                </ul>
            </div>`).appendTo(".dt-buttons");
            showHideColumn();


            $(`<a href="{{ route('documents.create') }}" style="margin-left:8px;">
                <button type="button" class="btn btn-info float-right">
                    <i class="fa fa-plus"></i> | Add New
                </button>
            </a>`).appendTo('.dataTables_filter');
            
        });


        function showHideColumn(){
           // alert('Working');
           var checkedCheckboxesValues = 
            $('input:checkbox[name="columns"]:checked').map(function() {
                    return $(this).val();
                }).get();
           console.log(checkedCheckboxesValues);

           for(var j=0; j<=10; j++){
                var column = table.column(j);
                if(checkedCheckboxesValues.indexOf(''+j)<0){
                    column.visible(false);
                }
                else{
                    column.visible(true);
                }
           }
        }

        function viewFile(path,filename){
            //var file_path = "/assets/uploads/documents/osk/CV-of-Omar-Shohid-Khan.pdf"; 
            //var file_path = "/assets/uploads/documents/osk/2022_01_17_07_24_barc_layer_list.xlsx"; 
            //var file_path = "/assets/uploads/documents/osk/CZIS Server Configuration & Network Infrastructure.docx"; 
            //var file_path = "/assets/uploads/documents/osk/annual-enterprise-survey-2020-financial-year-provisional-csv.csv"; 
            //var file_path = "/assets/uploads/documents/osk/set-daily-bing-wallpaper-background-featured.jpg"; 
            $("#resolte-contaniner").html('');
            $("#modalTitle").html('');
            $("#resolte-contaniner").removeAttr('class');
            $("#resolte-contaniner").officeToHtml({
                url: path,
                pdfSetting:$pdfSetting,
                docxSetting:$docxSetting,
                pptxSetting:$pptxSetting,
                sheetSetting:$sheetSetting,
                imageSetting:$imageSetting
            });
            
            if($('#resolte-contaniner').hasClass('wbSheets_clas')){
                $('#resolte-contaniner').removeClass('scroll');
            }
            else{
                $('#resolte-contaniner').addClass('scroll');
                if($('#resolte-contaniner').children().first().hasClass('image_viewer_inner_container') || $('#resolte-contaniner').children().first().hasClass('loadingInProgress')){
                    $('#resolte-contaniner').css('overflow-y','auto');
                }                           
            }
            $("#modalTitle").html("File: "+filename);
            $('#modal').modal({
                backdrop: 'static'
            }).show();
        }

        function confirmDelete(e){
            var result = confirm("Are you sure you want to delete?");
            if (result) {
                document.getElementById('delete-form-'+e).submit();
            }
        }
    
    </script>
@endsection
