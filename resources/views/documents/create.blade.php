@extends('layouts.backend-master')
@section('title', 'Document Create')
@section('css_before')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}">
@endsection
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('content')
    <style>
        #fileList li {
            list-style-type: disclosure-closed;
            font-size: 12px;
            font-weight: 600;
            color: #000000c2;
            font-family: 'simple-line-icons';
        }

        #fileList ul {
            padding-left: 15px;
            padding-top:5px;
        }
    </style>
    <!-- Breadcrumb -->
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center">
            <nav class="breadcrumb bg-body-light mb-0">
                <a class="breadcrumb-item" href="{{ url('/home') }}"><i class="fa fa-home"></i> Home</a>
                <span class="breadcrumb-item">DMMMS</span>
                <a class="breadcrumb-item" href="{{ route('documents.index') }}">Document List</a>
                <span class="breadcrumb-item active">Create Document</span>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->
    <!-- Page Content -->
    <div class="content">
        <!-- Progress Wizards -->
        <div class="row">
            <div class="col-md-12">
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
                            toastr.success({!!$message!!});
                    </script>
                @endif
            @endif
                <!-- Project Create Labels -->
                <div class="block">
                    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Create Document</h3>
                            <div class="block-options">
                                <a type="button" class="btn btn-danger" href="{{ route('documents.index') }}">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="row modify_section">
                                <div class="col-md-12">
                                <div class="row">
                                        <div class="col-md-6">                                            
                                            <div class="form-group">
                                                <label class="font-weight-bold">Document Type <span style="color:#EF5452">*</span></label>
                                                <div class="btn-group" style="-webkit-inline-box; width: 100%;">
                                                <select class="form-control" id="doc_type" onChange="ChangeRequiredOption()" name="doc_type" required>
                                                <option value="">----Select----</option>
                                                    @foreach($all_doctype as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>

                                                <button type="button" title="Add new document type" onClick="ShowModal()" data-toggle="modal-fadein" data-target="#modal-fadein" class="btn btn-primary {{Auth()->user()->role->code=='superadmin' ? '' : 'hidden'}}"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Title <span id="title_s" style="color:#EF5452">*</span></label>
                                                <input type="text" class="form-control" id="title" name="title" placeholder="" required>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="row">                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Description <span id="description_s" style="color:#EF5452"></span></label>
                                                <textarea type="text" class="ckeditor form-control" id="description" name="description" placeholder="" ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Ref. # <span id="ref_no_s" style="color:#EF5452"></span></label>
                                                <input type="text" class="form-control" id="ref_no" name="ref_no" placeholder="" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Client Name<span id="client_s" style="color:#EF5452"></span></label>
                                                <input type="text" class="form-control" id="client" name="client"  placeholder="" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label class="font-weight-bold">Date <span id="date_s" style="color:#EF5452">*</span></label>
                                                <!-- <input type="date" class="form-control" id="date" name="date" placeholder="Date" required> -->
                                                <input type="text" data-format="yyyy-mm-dd" class="form-control" id="date" name="date" value="{{ date('Y-m-d') }}" placeholder="" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Subject <span id="subject_s" style="color:#EF5452"></span></label>
                                                <input type="text" class="form-control" id="subject" name="subject" placeholder="" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">From  <span id="from_s" style="color:#EF5452"></span></label>
                                                <input type="text" class="form-control" id="from" name="from" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">To Whome <span id="to_whome_s" style="color:#EF5452"></span></label>
                                                <input type="text" class="form-control" id="to_whome" name="to_whome" placeholder="" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="col-md-6"  style="float:left; padding-left:0px;">
                                            <div class="form-group">
                                                <label class="font-weight-bold">File <span id="file_s" style="color:#EF5452"></span></label>
                                                <input type="file" style="height:55px; padding-top:13px;" onchange="javascript:updateList()" class="form-control" id="doc_link" name="doc_link[]" placeholder="" multiple>
                                                <div id="fileList">
                                                    
                                                </div>
                                            </div>
                                            </div>
                                           
                                            <div class="col-md-6" style="float:left; padding-right:0px;">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Directory <span id="file_s" style="color:#EF5452"></span></label>
                                                <input type="text" style="font-family: monospace;"  readonly="true" class="form-control" id="path" name="path" placeholder="" required>
                                            </div>
                                            <div id="jstree_demo"></div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Remarks <span id="remarks_s" style="color:#EF5452"></span></label>
                                                <textarea type="text" class="form-control" id="remarks" name="remarks" placeholder=""></textarea>
                                            </div>
                                        </div>
                                    </div>                                    
        
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal fade" id="modal-fadein" tabindex="-1" role="dialog" aria-labelledby="modal-fadein" aria-hidden="true">
                    <div class="modal-dialog" role="document" style="top:22%">
                    <div class="modal-content">
                        <div class="block block-rounded shadow-none mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Add a new document type:</h3>
                            <div class="block-options">
                            <button type="button" class="btn-block-option" onClick="CloseModal()" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times"></i>
                            </button>
                            </div>
                        </div>
                        <div class="block-content fs-sm">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="font-weight-bold">Document type name: <span id="subject_s" style="color:#EF5452">*</span></label>
                                <input type="text" class="form-control" id="documentTypeName" name="documentTypeName" placeholder="" >
                            </div>
                        </div>
                        </div>
                        <div class="block-content block-content-full block-content-sm text-end border-top">
                            <button type="button" class="btn btn-alt-secondary"  onClick="CloseModal()" data-bs-dismiss="modal">
                                Close
                            </button>    
                            <button type="button" class="btn btn-primary" onClick="SaveDocType()">
                                Save
                            </button>                      
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- END Project Create Labels -->
            </div>
        </div>
    </div>
    <!-- End Page Content -->
@endsection

@section('js_after')
    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/js/others/jstree.min.js') }}"></script>
    <script type="text/javascript">
        $('#date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            orientation: "bottom left"
        });

        updateList = function() {
            var input = document.getElementById('doc_link');
            var output = document.getElementById('fileList');
            var children = "";
            for (var i = 0; i < input.files.length; ++i) {
                children += '<li>' + input.files.item(i).name + '</li>';
            }
            output.innerHTML = '<ul>'+children+'</ul>';
        }

        var treeData = {!! $rootJson !!};
        var myTree = $('#jstree_demo').jstree({
            "core" : {
                "animation" : 0,
                "check_callback" : true,
                "themes" : { "stripes" : true },
                'data':treeData
                // 'data' : {
                // 'url' : function (node) {
                //     return node.id === '#' ?
                //     'ajax_demo_roots.json' : 'ajax_demo_children.json';
                // },
                // 'data' : function (node) {
                //     return { 'id' : node.id };
                // }
                // }
            },
            "contextmenu":{         
                "items": function($node) {
                    var tree = $("#jstree_demo").jstree(true);
                    return {
                        "Create": {
                            "separator_before": false,
                            "separator_after": false,
                            "label": "Create",
                            "action": function (obj) { 
                                $node = tree.create_node($node);
                                tree.edit($node);
                            }
                        },
                        // "Rename": {
                        //     "separator_before": false,
                        //     "separator_after": false,
                        //     "label": "Rename",
                        //     "action": function (obj) { 
                        //         tree.edit($node);
                        //     }
                        // },                         
                        // "Remove": {
                        //     "separator_before": false,
                        //     "separator_after": false,
                        //     "label": "Remove",
                        //     "action": function (obj) { 
                        //         tree.delete_node($node);
                        //     }
                        // }
                    };
                }
            },
            "types" : {
                "#" : {
                "max_children" : 1,
                "max_depth" : 10,
                "valid_children" : ["root"]
                },
                "root" : {
                "icon" : "/assets/media/tree_icon.png",
                "valid_children" : ["default"]
                },
                "default" : {
                "valid_children" : ["default","file"]
                },
                "file" : {
                "icon" : "glyphicon glyphicon-file",
                "valid_children" : []
                }
            },
            "plugins" : [
                "contextmenu", "dnd","unique",// "search",
                "state", "types", ""
            ]
        }).bind('ready.jstree', function (e, data) {    
            // $('#jstree_demo').jstree('close_all')    
        }).bind('delete_node.jstree', function (e, data) {
            alert('delete');
            e.preventDefault();
            return false;
        });
        myTree.on('changed.jstree', function(e, data) {
            if(data.action =='select_node'){
                //console.log(data);
                var path = data.instance.get_path(data.node,'/');
                //alert(path);
                $('#path').val("/"+path);
            }  
        });


        function ChangeRequiredOption(){
            var docType = $('#doc_type').val();

            var clientInput = $('#client');
            var clientS = $('#client_s');

            var subjectInput = $('#subject');
            var subjectS = $('#subject_s');

            var fromInput = $('#from');
            var fromS = $('#from_s');

            var to_whomeInput = $('#to_whome');
            var to_whomeS = $('#to_whome_s');

            var refInput = $('#ref');
            var refS = $('#ref_s');

            console.log(docType);
            // Report

            $(clientInput).removeAttr('required');
            $(subjectInput).removeAttr('required');
            $(fromInput).removeAttr('required');
            $(to_whomeInput).removeAttr('required');
            $(refInput).removeAttr('required');
            $(clientS).html('');
            $(subjectS).html('');
            $(fromS).html('');
            $(to_whomeS).html('');
            $(refS).html('');

            if(docType==1 || docType==4){
                $(clientInput).attr('required','true');
                $(subjectInput).attr('required','true');
                $(fromInput).attr('required','true');
                $(to_whomeInput).attr('required','true');                
                $(clientS).html('*');
                $(subjectS).html('*');
                $(fromS).html('*');
                $(to_whomeS).html('*');

                $(refInput).removeAttr('required');
                $(refS).html('');
            }
            //Letter
            else if(docType==2){
                $(subjectInput).attr('required','true');
                $(fromInput).attr('required','true');
                $(to_whomeInput).attr('required','true');
                $(refInput).attr('required','true');
                $(subjectS).html('*');
                $(fromS).html('*');
                $(to_whomeS).html('*');
                $(refS).html('*');
            }
            else if(docType==3){                
                $(subjectInput).attr('required','true');
                $(fromInput).attr('required','true');
                $(to_whomeInput).attr('required','true');  
                $(subjectS).html('*');
                $(fromS).html('*');
                $(to_whomeS).html('*');
            }
            else if(docType==5 || docType==6 || docType==7 ){
                $(clientInput).attr('required','true');
                $(subjectInput).attr('required','true');
                $(fromInput).attr('required','true');
                $(to_whomeInput).attr('required','true');
                $(clientS).html('*');
                $(subjectS).html('*');
                $(fromS).html('*');
                $(to_whomeS).html('*');
            }
        }

        function ShowModal(){
            $('#modal-fadein').modal().show();
        }

        function CloseModal(){
            $('#modal-fadein').modal('hide');
        }

        function SaveDocType(){
            var docType = $('#documentTypeName').val();
            if(docType != '' && typeof(docType) != 'undefined'){
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '/save-doc-type',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, docType:docType},
                    dataType: 'JSON',
                    success: function (data) { 
                        console.log(data);
                        if(data.status =='success'){
                            $('#modal-fadein').modal('hide');
                            toastr.success('Document type successfully added');
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        }
                        else{
                            toastr.error(data.msg);
                        }
                        //console.log(data);
                        
                    },
                    error: function (textStatus, errorThrown) {
                        console.log(textStatus);
                        toastr.error('Something went wrong please type again later');
                    }
                }); 
            }
            else{
                toastr.error('Please enter document type first');
            }
        }
    </script>
@endsection
