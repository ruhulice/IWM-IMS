@extends('layouts.backend-master')
@section('title', 'Edit Document')
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
        border-bottom: 1px solid #ddd;
            padding: 5px 0px;
        }
    
        #fileList ul {
            padding-left: 15px;
            padding-top:5px;
            
        }
        .closeulb {
            position: absolute;
            right: 5%;
            background-color: #ef5350;
            padding: 0px 7px;
            color: #fff;
            border-radius: 5px;
            line-height: 21px;
        }
   </style>

    <!-- Breadcrumb -->
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center">
            <nav class="breadcrumb bg-body-light mb-0">
                <a class="breadcrumb-item" href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a>
                <span class="breadcrumb-item">SDMS</span>
                <a class="breadcrumb-item" href="{{ route('documents.index') }}">Document List</a>
                <span class="breadcrumb-item active">Edit Document</span>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Project Edit Labels -->
                <div class="block">
                    <form action="{{ route('documents.update',$document->id) }}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        @method('PUT')
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Edit Document</h3>
                            <div class="block-options">
                                <a type="button" class="btn btn-danger" href="{{ route('documents.index') }}">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="row modify_section">
                                <div class="col-md-12">
                                <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Document Type <span style="color:#EF5452">*</span></label>
                                                <select class="form-control" id="doc_type" onChange="ChangeRequiredOption()" name="doc_type" value="{{$document -> doc_type}}" required>
                                                <option value="">----Select----</option>
                                                    @foreach($all_doctype as $item)
                                                        <option value="{{ $item->id }}" <?= ($item->id == $document->doc_type) ? "selected" : "" ?> >{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Title <span id="title_s" style="color:#EF5452">*</span></label>
                                                <input type="text" class="form-control" id="title" name="title" value="{{$document->title}}" placeholder="" required>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="row">                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Description <span id="description_s" style="color:#EF5452"></span></label>
                                                <textarea type="text" class="ckeditor form-control" id="description" name="description" placeholder="" >{{$document->description}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Ref. # <span id="ref_no_s" style="color:#EF5452"></span></label>
                                                <input type="text" class="form-control" id="ref_no" name="ref_no" value="{{$document->ref_no}}" placeholder="" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Client Name<span id="client_s" style="color:#EF5452"></span></label>
                                                <input type="text" class="form-control" id="client" name="client" value="{{$document->client}}"  placeholder="" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label class="font-weight-bold">Date <span id="date_s" style="color:#EF5452">*</span></label>
                                                <!-- <input type="date" class="form-control" id="date" name="date" placeholder="Date" required> -->
                                                <input type="text" data-format="yyyy-mm-dd" class="form-control" id="date" name="date" value="{{$document->date}}" placeholder="" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Subject <span id="subject_s" style="color:#EF5452"></span></label>
                                                <input type="text" class="form-control" id="subject" name="subject" value="{{$document->subject}}" placeholder="" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">From  <span id="from_s" style="color:#EF5452"></span></label>
                                                <input type="text" class="form-control" id="from" name="from" value="{{$document->from}}" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">To Whome <span id="to_whome_s" style="color:#EF5452"></span></label>
                                                <input type="text" class="form-control" id="to_whome" name="to_whome" value="{{$document->to_whome}}" placeholder="" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">File <span id="file_s" style="color:#EF5452"></span></label>
                                                <input type="file" style="height:55px; padding-top:13px;"  class="form-control" id="doc_link" name="doc_link" placeholder="">
                                            </div>
                                        </div> -->
                                        <div class="col-md-6">
                                            <div class="col-md-6"  style="float:left; padding-left:0px;">
                                            <div class="form-group">
                                                <label class="font-weight-bold">File <span id="file_s" style="color:#EF5452"></span></label>
                                                <input type="file" style="height:55px; padding-top:13px;"  onchange="javascript:updateList()"  class="form-control" id="doc_link" name="doc_link[]" placeholder="" multiple>
                                                <div id="fileList">
                                                    <ul>
                                                        @foreach ($document->documentfile as $file)                                                      
                                                            <li title="{{$file->file_name}}">{{$file->file_name}} <a onclick="deleteFile('{!! $file->id !!}')" style="cursor: pointer"><span class="closeulb">×</span></a></li>
                                                        @endforeach
                                                    </ul>
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
                                                <textarea type="text" class="form-control" id="remarks" name="remarks" placeholder="">{{$document->remarks}} </textarea>
                                            </div>
                                        </div>
                                    </div>                                    
                                    
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END Employee Edit Labels -->
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
        $(document).ready(function(){
            $('#doc_type').trigger('change');   
            $('#date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                orientation: "bottom left"
            });
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
        //$('.ckeditor').ckeditor();

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

        $('#submission_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            orientation: "bottom left"
        });

        function deleteFile(fileId){
            Swal.fire({
                title: 'Are you sure, you want to delete?',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                confirmButtonColor: "#ef5350",
                }).then((result) => {
                if (result.value) {
                    //Swal.fire('Delete!', '', 'success')
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '/delete-doc-file',
                        type: 'POST',
                        data: {_token: CSRF_TOKEN, id:fileId},
                        dataType: 'JSON',
                        success: function (data) { 
                            console.log(data);
                            if(data.status =='success'){
                                $('#modal-fadein').modal('hide');
                                toastr.success('File deleted successfully.');
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
            })
        }

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
    </script>
@endsection
